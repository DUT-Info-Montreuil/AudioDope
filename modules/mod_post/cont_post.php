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
                case "voir_post" :
                    $this->voir_post();
                    break;
                case "supprimer_post" :
                    $this->supprimer_post();
                    break;
                case "voter" :
                    $this->voter();
                    break;
                default :
                    die("action inexistante");
            }
            $this->vue->affichage();
            
        }
        public function voter() {
            $this->modele->voter();
        }

        public function supprimer_post() {
            $this->modele->supprimer_post();
            $lien = "Location: index.php?module=profil&action=voir_profil&idUser=" . $_SESSION['idUser'];
            header($lien);
        }

        public function voir_post() {
            $post = $this->modele->get_post();
            $this->vue->affiche_post($post['post'], $post['vote'], $post['nb_votes']);
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
            $this->vue->non_connecte();
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