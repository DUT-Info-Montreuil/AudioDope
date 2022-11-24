<?php

    if (constant("lala") != "layn")
        die("wrong constant");

    include_once('vue_generique.php');

    class VueCollection extends VueGenerique {
        
        public function __construct() {
            parent::__construct();
        }   

        //le formulaire reste rempli même si erreur
        public function form_collection() {
            echo '<h1 id="titre_rouge">Titre</h1>
            <FORM ACTION="index.php?module=collection&action=redaction" METHOD="POST" id="form_collec"> </br>
            <div class="mb-3">
                <INPUT TYPE="text" NAME="titre_collection" placeholder="Titre" MAXLENGTH="50" class="form-control">
            </div> </br>
            <div class="mb-3">
                <INPUT TYPE="text" NAME="description_collection" placeholder="description"  MAXLENGTH="150" class="form-control"> 
            </div> </br>
            
            <h3>Choisir tags</h3>
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

        public function creation_collection() {
            echo '<p>Collection créé!</p>';
        }
        public function ajout_post_dans_collection() {
            echo '<p>Ajoutée dans la collection</p>';
        }

        public function titre_deja_util() {
            echo '<p>Titre non disponible</p>';
        }

        public function titre_description_a_remplir() {
            echo '<p>Veuillez saisir un titre et une description</p>';
        }
        public function choix_collection($collection,$post){
            foreach($collection as $col){
                echo "<a href=\"index.php?module=collection&action=ajouter_post&idPost=$post&idCollection=$col[idCollection]\">".$col['titreCollection']."</a>".'<br>';
         
        }
    }
}
?>