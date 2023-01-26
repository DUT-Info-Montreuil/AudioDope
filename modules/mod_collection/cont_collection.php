<?php

    /*AudioDope - Version 1.0 - 2022
GNU GPL CopyLeft 2022-2032
Hugo COHEN - Ayoub BOUAZIZ - Steven YANG*/
    if (constant("lala") != "layn")
        die("wrong constant");

    include_once('modele_collection.php');
    include_once('vue_collection.php');
    
    class ContCollection {

        private $modele;
        private $vue;
        private $action;

        public function __construct() {
            $this->modele = new ModeleCollection();
            $this->vue = new VueCollection();
            $this->action = isset($_GET['action']) ? $_GET['action'] : "";
        }

        public function exec() {
            switch($this->action) {
                case "form_collection" :
                    $this->form_redaction();
                    break;
                case "redaction" :
                    $this->redaction_collection();
                    break;
                case "voir_collection" :
                    $this->voir_colllection();
                    break;
                case "ajouter_post":
                        $this->ajouter_unPost();
                        break;
                case "choix_collection":
                        $this->affiche_choix_collection($_GET['idPost']);
                        break;
                case "redaction_commentaire" :
                         $this->redaction_commentaire();
                         break;
                case "prive_collection":
                            $this->rendre_prive_collection();
                    break;
                default :
                    die("action inexistante");
            }
            $this->vue->affichage();
            
        }

        public function rendre_prive_collection(){
            $this->modele->rendre_collection_prive();
        }

        public function voir_colllection() {
            $posts = $this->modele->get_post_collection();
            $votes  = $this->modele->get_votes($posts);
            $nb_votes = $this->modele->get_nb_votes($posts,0);
            $tags = $this->modele->get_tags($posts);
            $aimer_tags = $this->modele->aimer_tags($tags);

            $this->vue->affiche_post_dans_collection($posts, $votes, $nb_votes, $tags, $aimer_tags ,$this->modele->getCollection());

            $this->vue->affiche_redac_commentaire_collection();
            $tab_com = $this->modele->get_commentaire();
            foreach ($tab_com as $com) {
               $this->vue->affiche_commentaire($com);
            }
       }
      


        public function redaction_commentaire() {
            if (isset($_SESSION['login'])) {
                $this->modele->redaction_commentaire();
                $this->vue->commentaire_envoye($_GET['idCollection']);
            }
        }


        public function form_redaction() {
            if (isset($_SESSION['login'])) {
                $this->vue->form_collection();
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
        public function ajouter_unPost(){
            $verif=$this->modele->verif_post_dans_collection();
            if($verif==1){
            $this->modele->ajouter_post();
            $this->vue->ajout_post_dans_collection();
         }else{
            $this->vue->post_deja_dans_collection();
            }
        }

        public function redaction_collection() {
            $verif = $this->modele->verif_titre();
            if ($verif == 1) {
                $this->modele->collection();
                $this->vue->creation_collection();
            } else if ($verif == 2) {
                $this->vue->titre_deja_util();
            } else if ($verif == 3) {
                $this->vue->titre_description_a_remplir();
            }
        }

        public function affiche_choix_collection($post){
            $this->vue->choix_collection($this->modele->getChoixCollection(),$post);
        }

        
        
    }
?>