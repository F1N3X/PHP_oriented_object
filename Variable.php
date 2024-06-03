<?php

abstract class Utils{

    //méthode qui permet de générer un nombre aléatoire en prenant comme argument un maximum et un minimum
    public static function generateRandomNumber($min, $max){
        //génération d'un nombre aléatoire
        return rand($min, $max);
    }
}

?>