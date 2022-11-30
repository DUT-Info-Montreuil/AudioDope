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
            $this->vue->indic_recherche($this->action);
            switch($this->action) {
                case 'recherche_post' : 
                    $this->recherche_post();
                    break;
                case 'recherche_user' : 
                    break;
                default : die("action inexistant");
            }
            $this->vue->affichage();
        } 

        public function recherche_post() {
            $this->vue->menu_filtre();
            $this->vue->indic_recherche($_GET['filtre']);
            switch($_GET['filtre']) {
                case 'tout' : 
                    $posts = $this->modele->recherche_posts();
                    break;
                case 'tag' : 
                    $posts = $this->modele->recherche_par_tag();
                    break;
                case 'titre' : 
                    $posts = $this->modele->recherche_par_titre();
                    break;
                case 'desc' : 
                    $posts = $this->modele->recherche_par_description();
                    break;
                case 'user' : 
                    $posts = $this->modele->recherche_par_user();
                    break;
                default : die("filtre inexistant");
            }

            $votes  = $this->modele->get_votes($posts);
            $nb_votes = $this->modele->get_nb_votes($posts);
            $tags = $this->modele->get_tags($posts);

            $this->vue->affiche_posts($posts, $votes, $nb_votes, $tags);
        }
    }
