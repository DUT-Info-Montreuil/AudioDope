<?php
// GNU GPL Copyleft 2022 

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
            $posts = $this->modele->get_recent();
            $votes  = $this->modele->get_votes($posts);
            $nb_votes = $this->modele->get_nb_votes($posts,0);
            $tags = $this->modele->get_tags($posts);
            $aimer_tags = $this->modele->aimer_tags($tags);

            $this->vue->affiche_posts($posts, $votes, $nb_votes, $tags, $aimer_tags);
        }

        public function suivi() {
            $posts = $this->modele->get_suivi();
            if ($posts == 0) {
                $this->vue->non_connecte();
            } else if ($posts == 1) {
                $this->vue->aucun_abonnement();
            } else {
                $votes  = $this->modele->get_votes($posts);
                $nb_votes = $this->modele->get_nb_votes($posts,0);
                $tags = $this->modele->get_tags($posts);
                $aimer_tags = $this->modele->aimer_tags($tags);

                $this->vue->affiche_posts($posts, $votes, $nb_votes, $tags, $aimer_tags);
            }
        }

        public function tendance() {
            $posts = $this->modele->get_tendance();
            if ($posts == 0) {
                $this->vue->non_connecte();
            } else if ($posts == 1) {
                $this->vue->pas_de_post_en_tendance();
            } else {
                $votes  = $this->modele->get_votes($posts);
                $nb_votes = $this->modele->get_nb_votes($posts,1);
                $tags = $this->modele->get_tags($posts);
                $aimer_tags = $this->modele->aimer_tags($tags);

                $this->vue->affiche_posts($posts, $votes, $nb_votes, $tags, $aimer_tags);
            }
        }

        public function recommandes() {
            $posts = $this->modele->get_recommandes();
            if ($posts == 0) {
                $this->vue->non_connecte();
            } else {
                $votes  = $this->modele->get_votes($posts);
                $nb_votes = $this->modele->get_nb_votes($posts,1);
                $tags = $this->modele->get_tags($posts);
                $aimer_tags = $this->modele->aimer_tags($tags);

                $this->vue->affiche_posts($posts, $votes, $nb_votes, $tags, $aimer_tags);
            }
        }

        public function decouverte() {
            $posts = $this->modele->get_decouverte();
            if ($posts == 0) {
                $this->vue->non_connecte();
            } else {
                $votes  = $this->modele->get_votes($posts);
                $nb_votes = $this->modele->get_nb_votes($posts,1);
                $tags = $this->modele->get_tags($posts);
                $aimer_tags = $this->modele->aimer_tags($tags);

                $this->vue->affiche_posts($posts, $votes, $nb_votes, $tags, $aimer_tags);
            }
        }
        
        public function exec() {
            $this->vue->menu();
            $this->vue->indic_section($this->action);
            switch($this->action) {
                case 'recommandes' : $this->recommandes(); break;
                case 'decouverte' : $this->decouverte(); break;
                case 'suivis' : $this->suivi(); break;
                case 'tendance' : $this->tendance(); break;
                case 'recent' : $this->recent(); break;
                default : $this->suivi();
            }
            $this->vue->affichage();
        }
    }    
?>