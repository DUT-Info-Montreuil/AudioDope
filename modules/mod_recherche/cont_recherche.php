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
                case 'section_user' : 
                    $this->recherche_par_user();
                    break;
                default : die("action inexistant");
            }
            $this->vue->affichage();
        } 

        public function recherche() {
            $this->vue->affiche_posts($this->modele->recherche());
        }

        public function recherche_par_tag() {
            $this->vue->affiche_posts($this->modele->recherche_par_tag());
        }

        public function recherche_par_titre() {
            $this->vue->affiche_posts($this->modele->recherche_par_titre());
        }

        public function recherche_par_user() {
            $this->vue->affiche_posts($this->modele->recherche_par_user());
        }
    }
