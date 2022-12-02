<?php
    // GNU GPL Copyleft 2022 
    if (constant("lala") != "layn")
        die("wrong constant");

    include_once('modele_menu.php');
    include_once('vue_menu.php');
    
    class ContMenu {

        private $modele;
        private $vue;
        private $action;

        public function __construct() {
            $this->modele = new ModeleMenu();
            $this->vue = new VueMenu();
            $this->vue->menu();
        }

        public function affichage() {
            $this->vue->affichage();
        }
    }
?>