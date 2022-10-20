<?php


    if (constant("lala") != "layn")
        die("wrong constant");

    include_once('modele_accueil.php');
    include_once('vue_accueil.php');
    
    class ContAccueil {

        private $modele;
        private $vue;
        private $action;

        public function __construct() {
            $this->modele = new ModeleAccueil();
            $this->vue = new VueAccueil();
            $this->action = isset($_GET['action']) ? $_GET['action'] : "recent";
        }

        public function recent() {

        }
        
        public function exec() {
            $this->vue->menu();
            $this->vue->indic_section($this->action);
            switch($this->action) {
                case 'recommandes' : break;
                case 'decouverte' : break;
                case 'suivis' : break;
                case 'tendance' : break;
                case 'recent' : $this->recent(); break;
                default : die("action inexistant"); break;
            }
            $this->vue->affichage();
        }
    }    
?>