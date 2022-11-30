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
            $this->action = isset($_GET['action']) ? $_GET['action'] : "";
        }

        public function recent() {
            $posts = $this->modele->get_recent(0);
            $votes  = $this->modele->get_votes($posts);
            $nb_votes = $this->modele->get_nb_votes($posts);
            $tags = $this->modele->get_tags($posts);

            $this->vue->affiche_posts($posts, $votes, $nb_votes, $tags);
        }

        public function suivi() {
            $posts = $this->modele->get_suivi(0);
            if ($posts == 0) {
                $this->vue->non_connecte();
            } else if ($posts == 1) {
                $this->vue->aucun_abonnement();
            } else {
                $votes  = $this->modele->get_votes($posts);
                $nb_votes = $this->modele->get_nb_votes($posts);
                $tags = $this->modele->get_tags($posts);

                $this->vue->affiche_posts($posts, $votes, $nb_votes, $tags);
            }
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