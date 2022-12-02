<?php
// GNU GPL Copyleft 2022 

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
                case "redaction_commentaire" :
                    $this->redaction_commentaire();
                    break;
                default :
                    die("action inexistante");
            }
            $this->vue->affichage();
            
        }

        public function voir_post() {
            $post = $this->modele->get_post();
            $vote  = $this->modele->get_vote($post['idPost']);
            $nb_votes = $this->modele->get_nb_vote($post['idPost']);
            $tags = $this->modele->get_tag($post['idPost']);
            $aimer_tags = $this->modele->aimer_tag($tags);
            
            $this->vue->affiche_post($post, $vote, $nb_votes, $tags, $aimer_tags);
            
            $this->vue->affiche_redac_commentaire();
            $tab_com = $this->modele->get_commentaire();
            foreach ($tab_com as $com) {
                    $this->vue->affiche_commentaire($com);
            }
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

        public function redaction_commentaire() {
            if (isset($_SESSION['login'])) {
                $this->modele->redaction_commentaire();
                $this->vue->commentaire_envoye($_GET['idPost']);
            }
        }

        public function redaction() {
            $verif = $this->modele->verif_titre();
            if ($verif == 1) {
                $idPost = $this->modele->redaction();
                header("Location: index.php?module=post&action=voir_post&idPost=$idPost");
            } else if ($verif == 2) {
                $this->vue->titre_deja_util();
            } else if ($verif == 3) {
                $this->vue->titre_lien_a_remplir();
            }
        }
    }
?>