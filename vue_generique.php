<?php

    if (constant("lala") != "layn")
        die("wrong constant");

    class VueGenerique {

        public function __construct() {
            ob_start();
        }    

        public function  getAffichage() {
            return ob_get_clean();
        }

        public function nonConnecte() {
            echo "Vous n'êtes pas connecté";
        }

        public function deja_connecte() {
            $login = htmlspecialchars($_SESSION['login']);
            echo "Vous êtes déjà connecté sous l’identifiant $login <br> <a href=\"index.php?module=connexion&action=deconnexion\">Se déconnecter</a>";
        }

        public function affichage() {
            global $affichage;
            $affichage = $this->getAffichage();
        }
    }
?>