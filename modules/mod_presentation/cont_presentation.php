<?php

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