<?php

    if (constant("lala") != "layn")
        die("wrong constant");

    include_once('cont_menu.php');

    class CompMenu {

        private $controleur;
        
        public function __construct() {
            $this->controleur = new ContMenu();
        }

        public function affichage() {
            $this->controleur->affichage();
        }
    }
?>