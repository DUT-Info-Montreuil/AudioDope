<?php
    /*AudioDope - Version 1.0 - 2022
GNU GPL CopyLeft 2022-2032
Hugo COHEN - Ayoub BOUAZIZ - Steven YANG*/
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