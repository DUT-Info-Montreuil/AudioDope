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
                    $this->recherche();
                    break;
                case 'section_tag' : 
                    $this->recherche_par_tag();
                    break;
                case 'section_titre' : 
                    $this->recherche_par_titre();
                    break;
                case 'section_desc' : 
                    $this->recherche_par_description();
                    break;
                case 'section_user' : 
                    $this->recherche_par_user();
                    break;
                default : die("action inexistant");
            }
            $this->vue->affichage();
        } 

        public function recherche() {
            $posts = $this->modele->recherche();
            $votes  = $this->modele->get_votes($posts);
            $nb_votes = $this->modele->get_nb_votes($posts,0);
            $tags = $this->modele->get_tags($posts);

            $this->vue->affiche_posts($posts, $votes, $nb_votes, $tags);
        }

        public function recherche_par_tag() {
            $posts = $this->modele->recherche_par_tag();
            $votes  = $this->modele->get_votes($posts);
            $nb_votes = $this->modele->get_nb_votes($posts,0);
            $tags = $this->modele->get_tags($posts);

            $this->vue->affiche_posts($posts, $votes, $nb_votes, $tags);
        }

        public function recherche_par_titre() {
            $posts = $this->modele->recherche_par_titre();
            $votes  = $this->modele->get_votes($posts);
            $nb_votes = $this->modele->get_nb_votes($posts,0);
            $tags = $this->modele->get_tags($posts);

            $this->vue->affiche_posts($posts, $votes, $nb_votes, $tags);
        }
        
        public function recherche_par_description() {
            $posts = $this->modele->recherche_par_description();
            $votes  = $this->modele->get_votes($posts);
            $nb_votes = $this->modele->get_nb_votes($posts,0);
            $tags = $this->modele->get_tags($posts);

            $this->vue->affiche_posts($posts, $votes, $nb_votes, $tags);
        }

        public function recherche_par_user() {
            $posts = $this->modele->recherche_par_user();
            $votes  = $this->modele->get_votes($posts);
            $nb_votes = $this->modele->get_nb_votes($posts,0);
            $tags = $this->modele->get_tags($posts);

            $this->vue->affiche_posts($posts, $votes, $nb_votes, $tags);
        }
    }
