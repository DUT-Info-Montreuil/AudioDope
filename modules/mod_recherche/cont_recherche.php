<?php
    if (constant("lala") != "layn")
        die("wrong constant");

    include_once('modele_recherche.php');
    include_once('vue_recherche.php');
    
    class ContRecherche {

        private $modele;
        private $vue;
        private $action;

        public function __construct() {
            $this->modele = new ModeleRecherche();
            $this->vue = new VueRecherche();
            $this->action = isset($_GET['action']) ? $_GET['action'] : "";
        }

        public function exec() {
            $this->vue->menu();
            $this->vue->indic_section($this->action);
            switch($this->action) {
                case 'section_tout' : 
                    break;
                case 'section_tag' : 
                    break;
                case 'section_titre' : 
                    break;
                case 'section_user' : 
                    break;
                default : die("action inexistant");
            }
            $this->vue->affichage();
        } 
    }
