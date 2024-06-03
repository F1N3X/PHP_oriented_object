<?php

class Game{

    private $hero;
    private $enemy;


    //méthode d'initialisation du joueur
    public function generateHero(){
        //liste des 3 personnages que le joueur peut incarner avec leur valeurs de bonus, malus, nom, nombre de billes
        $list_of_characters = [
            [1, 2, "Seong Gi-hun", 15],
            [2, 1, "Kang Sae-byeok", 25],
            [3, 0, "Cho Sang-woo", 35]
        ];

        //génération d'un nombre aléatoire entre 0 et 2 grâce à la classe Utils
        $chooseHeroe = Utils::generateRandomNumber(0, 2);

        //on initialise un personnage de la classe Hero avec les valeurs du personnage correspondant à celui du rang de $chooseHeroe dans le tableau $list_of_characters
        $this->hero = new Hero($list_of_characters[$chooseHeroe][0], $list_of_characters[$chooseHeroe][1], $list_of_characters[$chooseHeroe][2], $list_of_characters[$chooseHeroe][3]);
        echo "Vous avez choisi le personnage : " . $this->hero->getName() . "<br>";
    }


    //méthode d'initialisation des ennemis
    public function generateEnemies($difficulty){
        //liste des nombres d'ennemis en fonction de la difficulté
        $amount_of_enemies = array(5, 10, 20);
        //liste des niveaux de difficulté
        $list_of_difficulties = array("Facile", "Moyen", "Difficile");
        echo "<br> Difficulté de la partie : " . $list_of_difficulties[$difficulty] . "<br>";

        //on initialise une boucle qui fera autant de tours qu'il y a d'ennemis par rapport à la difficulté choisie
        for ($i=0; $i < $amount_of_enemies[$difficulty]; $i++) { 
            //à chaque tour de boucle :

            //on génère un nombre aléatoire entre 0 et 100 correspondant à l'âge de l'ennemi
            $age = Utils::generateRandomNumber(0, 100);
            //on génère un nombre aléatoire entre 1 et 20 correspondant au nombre de billes de l'ennemi
            $enemyBalls = Utils::generateRandomNumber(1, 20);
            //on initialise un ennemi de la classe Enemy au rang actuel de la boucle avec les valeurs générées précédemment
            $this->enemy[$i] = new Enemy($age, "Enemy", $enemyBalls);
        }

    }


    //méthode de lancement et de déroulé de la partie
    public function startGame(){
        //génération d'un nombre aléatoire entre 0 et 2 correspondant à la difficulté
        $difficulty = Utils::generateRandomNumber(0, 2);

        //appel des méthodes d'initialisation du joueur et des ennemis par rapport à la difficulté choisie
        $this->generateHero();
        $this->generateEnemies($difficulty);

        echo "<br>";

        //on initialise une boucle qui fera autant de tours qu'il y a d'ennemis tant qu'il reste des billes au joueur
        for ($i=0; $i < count($this->enemy) && $this->hero->getBalls() > 0; $i++) { 

            //on affiche les caractéristiques de l'ennemi actuel
            echo "Vous avez rencontré un ennemi qui a " . $this->enemy[$i]->getAge() . " ans et " . $this->enemy[$i]->getBalls() . " billes <br>";
            
            //vérification de si le joueur triche ou non
            $this->hero->tricher = $this->hero->tricherOuPas();

            //si l'ennemi a plus de 70 ans et que le joueur décide de tricher
            if ($this->enemy[$i]->getAge() >= 70 && $this->hero->tricher == true) {
                echo "Vous choisissez de tricher ! <br>";
                
                //le héro récupère les billes de l'ennemi
                $this->hero->setBalls($this->hero->getBalls() + $this->enemy[$i]->getBalls());
                //l'ennemi perd toutes ses billes
                $this->enemy[$i]->setBalls(0);
                echo "Vous avez maintenant " . $this->hero->getBalls() . " billes <br>";
            }

            //so l'ennemi a moins de 70 ans ou que le joueur décide de ne pas tricher
            else{
                
                //on appelle la méthode qui vérifie si le joueur décide de jouer pair ou non
                $heroPairOrNot = $this->hero->pairOuImpair();

                //on vérifie si l'ennemi joue pair ou non en vérifiant le reste de la division euclidienne par 2 du nombre de billes de l'ennemi
                if ($this->enemy[$i]->getBalls() % 2 == 0) {
                    //si le reste de la division euclidienne par 2 du nombre de billes de l'ennemi est égal à 0 alors le chiffre est pair
                    $enemyPairOrNot = true;
                }
                else{
                    //sinon, il est impair
                    $enemyPairOrNot = false;
                }

                //on compare le choix du joueur et par rapport au nombre de billes de l'ennemi
                if ($heroPairOrNot === $enemyPairOrNot) {
                    //s'il trouve le bon résultat

                    echo "Vous avez gagné ! <br>";
                    //le héro récupère les billes de l'ennemi et son bonus 
                    $this->hero->setBalls($this->hero->getBalls() + $this->enemy[$i]->getBalls() + $this->hero->getBonus());
                    //l'ennemi perd toutes ses billes
                    $this->enemy[$i]->setBalls(0);
                    echo "Vous avez maintenant " . $this->hero->getBalls() . " billes <br>";
                }
                else{
                    //s'il ne trouve pas le bon résultat

                    echo "Vous avez perdu ! <br>";
                    //le héro perd le même nombre de billes que possède l'ennemi ainsi que son malus
                    $this->hero->setBalls($this->hero->getBalls() - $this->enemy[$i]->getBalls() - $this->hero->getMalus());
                    
                    //s'il reste des billes au joueur
                    if ($this->hero->getBalls() > 0) {
                        //afficher le nombre de billes restantes
                        echo "Vous avez maintenant " . $this->hero->getBalls() . " billes <br>";
                    }
                }
            }
            echo "<br>";
            //fin de boucle d'affrontement des ennemis
        }
        //si le joueur n'a plus de billes
        if ($this->hero->getBalls() <= 0) {
            echo "Vous avez perdu la partie ! <br>";
        }
        //s'il lui reste des billes
        else{
            echo "Vous avez gagné la partie ! <br>";
        }
    }
}

?>