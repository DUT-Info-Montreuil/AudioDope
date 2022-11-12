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
            $this->action = isset($_GET['action']) ? $_GET['action'] : "suivis";
        }

        public function recent() {
            $this->vue->affiche_posts($this->modele->get_recent());
        }

        public function suivi() {
            $tab = $this->modele->get_suivi();
            if ($tab == 0) {
                $this->vue->non_connecte();
            } else if ($tab == 1) {
                $this->vue->aucun_abonnement();
            } else 
                $this->vue->affiche_posts($tab);
        }
        
        public function exec() {
            $this->vue->menu();
            $this->vue->indic_section($this->action);
            switch($this->action) {
                case 'recommandes' : break;
                case 'decouverte' : break;
                case 'suivis' : $this->suivi(); break;
                case 'tendance' : break;
                case 'recent' : $this->recent(); break;
                default : die("action inexistant");
            }
            $this->vue->affichage();
        }
    }    
?>