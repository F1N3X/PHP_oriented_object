<?php 

//appel de toutes les classes qui permettent de lancer la partie
require_once("Character.php");
require_once("Game.php");
require_once("Variable.php");


//initialisation de la partie
$game = new Game();
//lancement de la partie avec la méthode de la classe Game
$game->startGame();

?>