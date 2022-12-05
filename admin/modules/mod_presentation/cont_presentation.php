<?php
/*AudioDope - Version 1.0 - 2022
GNU GPL CopyLeft 2022-2032
Hugo COHEN - Ayoub BOUAZIZ - Steven YANG*/
    if (constant("lala") != "layn")
        die("wrong constant");

    include_once('modele_presentation.php');
    include_once('vue_presentation.php');
    
    class ContPresentation {

        private $modele;
        private $vue;
        private $action;

        public function __construct() {
            $this->modele = new ModelePresentation();
            $this->vue = new VuePresentation();
            $this->vue->menu();
            $this->vue->affichage();
        }

    }
?>