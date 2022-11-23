<?php


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
                case "supprimer_collection" :
                    $this->supprimer_collection();
                    break;
                case "ajouter_post":
                        $this->ajouter_unPost($_GET['idPost']);
                default :
                    die("action inexistante");
                    break;
            }
            $this->vue->affichage();
            
        }

        public function supprimer_collection() {
            $this->modele->supprimer_collection();
            $lien = "Location: index.php?module=profil&action=voir_profil&idUser=" . $_SESSION['idUser'];
            header($lien);
        }

        public function voir_colllection() {
            $this->vue->affiche_collections($this->modele->getCollection(),$this->modele->get_post_collection());
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
        public function ajouter_unPost($idPost){
            $this->modele->ajouter_post($idPost);
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
        
    }
?>