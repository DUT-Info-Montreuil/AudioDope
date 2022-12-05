<?php
/*AudioDope - Version 1.0 - 2022
GNU GPL CopyLeft 2022-2032
Hugo COHEN - Ayoub BOUAZIZ - Steven YANG*/
    if (constant("lala") != "layn")
        die("wrong constant");

    include_once('vue_generique.php');

    class VuePost extends VueGenerique {
        
        public function __construct() {
            parent::__construct();
        }   

        //le formulaire reste rempli même si erreur
        public function form_redaction() {
            echo '<h1 id="titre_rouge">Rédiger</h1>
            <FORM ACTION="index.php?module=post&action=redaction" METHOD="POST" id="form_redac"> </br>
            <div class="mb-3">
                <INPUT TYPE="text" NAME="titre_post" placeholder="Titre" MAXLENGTH="50" class="form-control">
            </div> </br>
            <div class="mb-3">
                <INPUT TYPE="url" NAME="lien_post" placeholder="Lien"  MAXLENGTH="150" class="form-control"> 
            </div> </br>
            <div class="mb-3">
                <TEXTAREA class="form-control" NAME="corps_post" placeholder="Corps" MAXLENGTH="1000" rows="20"></textarea>
            </div> </br>
            <h3 id="titre_rouge">Choisir Tags</h3>
            <div class="input-group mb-3" id="selec_tag">';
            

        }

        //Rajouter fonctionnalité recherche en js
        public function form_redaction_tag($genre, $annee, $artiste, $num) {
            echo '
            <select name="tag' . $num . '" class="form-select" id="inputGroupSelect01">
                    <option value="">--NONE--</option>
                    <option value="">--GENRES--</option>';
            foreach ($genre as $a) {
                echo '<option value="' . $a[1] . '">' . $a[0] . '</option>';
            }
            echo '<option value="">--ARTISTES--</option>';
            foreach ($artiste as $a) {
                echo '<option value="' . $a[1] . '">' . $a[0] . '</option>';
            }    
            echo '<option value="">--ANNEES--</option>';
            foreach ($annee as $a) {
                echo '<option value="' . $a[1] . '">' . $a[0] . '</option>';
            }    
            echo '</select>';
        }

        public function form_redaction_fin() {
            echo '</div>
            </br>
            <INPUT CLASS="btn btn-primary" TYPE="SUBMIT" NAME="bouton" value="Poster"> 
            </FORM>';
        }

        public function post_envoye($idPost) {
            echo '<a href ="index.php?module=post&action=voir_post&idPost=' . $idPost . '">Bien envoyé! - Cliquer pour accéder au post</a>';
        }

        public function commentaire_envoye($idPost) {
            echo '<a href ="index.php?module=post&action=voir_post&idPost=' . $idPost . '">Bien envoyé! - Cliquer pour revenir au post</a>';
        }

        public function titre_deja_util() {
            echo '<p>Titre non disponible</p>';
        }

        public function titre_lien_a_remplir() {
            echo '<p>Veuillez saisir un titre et un lien</p>';
        }
    }
?>