<?php
    
    if (constant("lala") != "layn")
        die("wrong constant");

    class Connexion {
        protected static $bdd;

        public static function initConnexion() {
            self::$bdd = new PDO ('mysql:dbname=dutinfopw201652;host=database-etudiants.iut.univ-paris8.fr','dutinfopw201652', 'suzasasa');
        }
    }
?>