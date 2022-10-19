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
            //$this->vue->menu();
            switch($this->action) {
                case 'recent' : $this->recent(); break;
                default : die("action inexistant"); break;
            }
            $this->vue->affichage();
        }
    }    
?>