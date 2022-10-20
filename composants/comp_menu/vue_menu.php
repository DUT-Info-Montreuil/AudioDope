<?php


    if (constant("lala") != "layn")
        die("wrong constant");

    include_once('vue_generique.php');
    
    class VueMenu extends VueGenerique {
        
        private $affichage;

        public function __construct() {
            parent::__construct();
        }   

        public function menu() {
            $this->affichage = "<a href=\"index.php?module=accueil\"><h1>AudioDope</h1></a>";
			if (isset($_SESSION['login'])) {
                $this->affichage = $this->affichage." <a href=\"index.php?module=post&action=form_redaction\">Rédiger un post</a>";
                $this->affichage = $this->affichage." <a href=\"index.php?module=profil&action=voir_profil&idUser=".$_SESSION['idUser']."\">Profil</a>";
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