<?php
    /*AudioDope - Version 1.0 - 2022
    GNU GPL CopyLeft 2022-2032
    Hugo COHEN - Ayoub BOUAZIZ - Steven YANG*/

    if (constant("lala") != "layn")
        die("wrong constant");

        class Connexion {

            static protected $bdd;
            
            static private $id = "dutinfopw201625";
            static private $dbname = "dutinfopw201625";
            static private $mdp = "razamaqe";
            static private $adress = "database-etudiants.iut.univ-paris8.fr";
            
            public static function initConnexion() {
                self :: $bdd = new PDO ('mysql:host='.self::$adress.';dbname='.self::$dbname.'', self::$id, self::$mdp);
            
            }
        }
?>