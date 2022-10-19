<?php

    if (constant("lala") != "layn")
        die("wrong constant");

    include_once('vue_generique.php');

    class VuePost extends VueGenerique {
        
        public function __construct() {
            parent::__construct();
        }   

        //Faire en sorte que si titre déjà pris, le formulaire reste rempli
        public function form_redaction() {
            echo '<h1>Rédiger</h1>
            <FORM ACTION="index.php?module=post&action=redaction" METHOD="POST"> </br>
            <INPUT TYPE="text" NAME="titre_post" placeholder="Titre" MAXLENGTH="50" > </br>
            <INPUT TYPE="url" NAME="lien_post" placeholder="Lien" MAXLENGTH="150"> </br>
            <TEXTAREA NAME="corps_post" placeholder="Corps" MAXLENGTH="1000" > </textarea> </br>
            <INPUT CLASS="bouton_co_ins" TYPE="SUBMIT" NAME="bouton" value="Poster"> 
            </FORM>';
        }

        public function post_envoye() {
            echo 'bien envoyé';
        }

        public function titre_deja_util() {
            echo 'titre non disponible';
        }
    }
?>