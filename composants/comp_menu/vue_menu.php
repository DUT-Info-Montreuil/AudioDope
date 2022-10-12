<?php
    include_once('vue_generique.php');
    
    class VueMenu extends VueGenerique {
        
        private $affichage;

        public function __construct() {
            parent::__construct();
        }   

        public function menu() {
            $this->affichage = "<a href=\"index.php\"><h1>MVC</h1></a>";

			if (isset($_SESSION['login'])) {
				$this->affichage = $this->affichage." <a href=\"index.php?module=connexion&action=deconnexion\">Se déconnecter</a>";
			} else {
				$this->affichage = $this->affichage." <a href=\"index.php?module=connexion\">se connecter</a>";
        	}
        }

        public function affichage() {
            echo $this->affichage;
        }
    }
?>