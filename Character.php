<?php

//initialisation de la classe Character
class Character{

    private $name;
    private $balls;

    //initialisation du constructeur de la classe Character
    public function __construct($name, $balls){
        //nom du personnage
        $this->name = $name;
        //nombre de billes qu'il possède
        $this->balls = $balls;
    }

    //méthode pour récupérer le nom du personnage qui est privé
    public function getName(){
        return $this->name;
    }

    //méthode pour récupérer le nombre de billes du personnage qui est privé
    public function getBalls(){
        return $this->balls;
    }

    //méthode pour modifier le nombre de billes du personnage
    public function setBalls($balls){
        $this->balls = $balls;
    }
}


//initialisation de la classe Hero qui hérite de la classe Character
class Hero extends Character{

    private $bonus;
    private $malus;

    //initialisation du constructeur de la classe Hero
    public function __construct($bonus, $malus, $name, $balls){
        //valeur du bonus du héro
        $this->bonus = $bonus;
        //valeur du malus du héro
        $this->malus = $malus;

        // J'appelle le constructerur de la classe parente
        parent::__construct($name, $balls);
    }


    //méthode qui permet de vérifier si le joueur a décidé de jouer pair ou non
    function checkPairOrNot($pairOrNot){
        //si la véleur reçue en paramètre est égale à 0
        if($pairOrNot == 0){
            //alors c'est que le joueur a décidé de jouer pair
            return true;
        //sinon
        }else{
            //c'est qu'il a décidé de jouer impair
            return false;
        }
    }


    //méthode qui défini si le joueur joue pair ou non
    function pairOuImpair(){
        //on génère un nombre aléatoire entre 0 et 1
        $choosePairOrNot = Utils::generateRandomNumber(0, 1);
        //on appelle la méthode qui vérifie si le joueur a décidé de jouer pair ou non
        return $this->checkPairOrNot($choosePairOrNot);
    }


    //méthode qui permet de vérifier si le joueur souhaite tricher ou non
    function tricherOuPas(){
        //on génère un nombre aléatoire entre 0 et 1
        $tricher = Utils::generateRandomNumber(0, 1);
        //si le nombre aléatoire est égal à 0
        if($tricher == 0){
            //alors le joueur décide de tricher
            return true;
        //sinon
        }else{
            //il ne triche pas
            return false;
        }
    }


    //méthode qui permet de récupérer la valeur du bonus du héro
    function getBonus(){
        return $this->bonus;
    }


    //méthode qui permet de récupérer la valeur du malus du héro
    function getMalus(){
        return $this->malus;
    }
}



//initialisation de la classe Enemy qui hérite de la classe Character
class Enemy extends Character{

    private $age;

    //initialisation du constructeur de la classe Enemy
    public function __construct($age, $name, $balls){
        //âge de l'ennemi
        $this->age = $age;

        // J'appelle le constructerur de la classe parente
        parent::__construct($name, $balls);
    }

    //méthode qui permet de récupérer l'âge de l'ennemi
    public function getAge(){
        return $this->age;
    }
}

?>