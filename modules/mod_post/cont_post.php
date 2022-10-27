<?php


    if (constant("lala") != "layn")
        die("wrong constant");

    include_once('modele_post.php');
    include_once('vue_post.php');
    
    class ContPost {

        private $modele;
        private $vue;
        private $action;

        public function __construct() {
            $this->modele = new ModelePost();
            $this->vue = new VuePost();
            $this->action = isset($_GET['action']) ? $_GET['action'] : "";
        }

        public function exec() {
            
                switch($this->action) {
                    case "form_redaction" :
                        $this->form_redaction();
                        break;
                    case "redaction" :
                        $this->redaction();
                        break;
                    default :
                        die("action inexistante");
                        break;
                }
                $this->vue->affichage();
            
        }

        public function form_redaction() {
            if (isset($_SESSION['login'])) {
                $this->vue->form_redaction();
                $genre = $this->modele->redac_tag('genre');
                $annee = $this->modele->redac_tag('annee');
                $artiste = $this->modele->redac_tag('artiste');
                $this->vue->form_redaction_tag($genre, $annee, $artiste, 1);
                $this->vue->form_redaction_tag($genre, $annee, $artiste, 2);
                $this->vue->form_redaction_tag($genre, $annee, $artiste, 3);
                $this->vue->form_redaction_fin();
            }
            else
            $this->vue->nonConnecte();
        }

        public function redaction() {
            $verif = $this->modele->verif_titre();
            if ($verif == 1) {
                $this->modele->redaction();
                $this->vue->post_envoye();
            } else if ($verif == 2) {
                $this->vue->titre_deja_util();
            } else if ($verif == 3) {
                $this->vue->titre_lien_a_remplir();
            }
        }
    }
?>