<?php

	class Connexion {

		static protected $bdd;
		
		static private $dbname = "dutinfopw201625";
		static private $mdp = "razamaqe";
		static private $adress = "database-etudiants.iut.univ-paris8.fr";
		
		public static function initConnexion() {
			self :: $bdd = new PDO ('mysql:host='.self::$adress.';dbname='.self::$dbname.'', self::$dbname, self::$mdp);
		
		}
	}

?>
