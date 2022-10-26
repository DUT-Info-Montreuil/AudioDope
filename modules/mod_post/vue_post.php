<?php

    if (constant("lala") != "layn")
        die("wrong constant");

    include_once('vue_generique.php');

    class VuePost extends VueGenerique {
        
        public function __construct() {
            parent::__construct();
        }   

        //Faire en sorte que si titre déjà pris ou vide, le formulaire reste rempli
        public function form_redaction() {
            echo '<h2>Rédiger</h2>
            <FORM ACTION="index.php?module=post&action=redaction" METHOD="POST" id="form_redac"> </br>
            <div class="mb-3">
                <INPUT TYPE="text" NAME="titre_post" placeholder="Titre" MAXLENGTH="50" class="form-control">
            </div> </br>
            <div class="mb-3">
                <INPUT TYPE="url" NAME="lien_post" placeholder="Lien" MAXLENGTH="150" class="form-control"> 
            </div> </br>
            <div class="mb-3">
                <TEXTAREA class="form-control" NAME="corps_post" placeholder="Corps" MAXLENGTH="1000" rows="20"></textarea>
            </div> </br>
            <INPUT CLASS="btn btn-primary" TYPE="SUBMIT" NAME="bouton" value="Poster"> 
            </FORM>';
        }

        public function post_envoye() {
            echo '<p>Bien envoyé!</p>';
        }

        public function titre_deja_util() {
            echo '<p>Titre non disponible</p>';
        }
    }
?>