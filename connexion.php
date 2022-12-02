<?php
    
    if (constant("lala") != "layn")
        die("wrong constant");

        class Connexion {

            static protected $bdd;
            
            static private $id = "root";
            static private $dbname = "dutinfopw201625";
            static private $mdp = "";
            static private $adress = "localhost";
            
            public static function initConnexion() {
                self :: $bdd = new PDO ('mysql:host='.self::$adress.';dbname='.self::$dbname.'', self::$id, self::$mdp);
            
            }
        }
?>