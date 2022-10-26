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
            $this->affichage = "<a href=\"index.php?module=accueil\"><h1 class=\"titre\" id=titre1>Audio</h1><h1 class=\"titre\" id=titre2>Dope</h1></a><br>";
			if (isset($_SESSION['login'])) {
                $this->affichage = $this->affichage." <ul class=\"nav justify-content-center\" id=\"navbar\"> " .
                "<li class=\"nav-item\">" .
                "<a class=\"nav-link\" href=\"index.php?module=profil&action=voir_profil&idUser=".$_SESSION['idUser']."\">Profil</a>";
				$this->affichage = $this->affichage . "<li class=\"nav-item\">" .
                "<a class=\"nav-link\" href=\"index.php?module=connexion&action=deconnexion\">Se déconnecter</a></li>";
                $this->affichage = $this->affichage . "<li class=\"nav-item\">" .
                "<a class=\"nav-link\" href=\"index.php?module=post&action=form_redaction\">Rédiger un post</a></li>";
			} else {
				$this->affichage = $this->affichage." <a href=\"index.php?module=connexion\">Se connecter</a>";
        	}
        }

        public function affichage() {
            echo $this->affichage;
        }
    }
