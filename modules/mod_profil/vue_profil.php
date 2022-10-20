<?php

    if (constant("lala") != "layn")
        die("wrong constant");

    include_once('vue_generique.php');

    class VueProfil extends VueGenerique {
        
        public function __construct() {
            parent::__construct();
        }

        public function afficher_profil($profil) {
            echo $profil['login']."<br/>".$profil['nb_abonnes']." abonnés  ".$profil['nb_abonnement']." abonnements";
          
            echo$profil['idUser']; echo $_SESSION['idUser'];
        }

        public function afficherform_abonnement($profil){
            echo '<FORM ACTION="index.php?module=profil&action=abonner&idUser='.$profil['idUser'].'" METHOD="POST"> 
            <input type="hidden" name="token" value='.$_SESSION['token'].'>
            <INPUT CLASS="bouton_co_ins" TYPE="SUBMIT" NAME="bouton" value="s\'abonner"> 
            </FORM>';
            
        }
        public function afficherform_desabonnement($profil){
            echo '<FORM ACTION="index.php?module=profil&action=desabonner&idUser='.$profil['idUser'].'" METHOD="POST"> 
            <input type="hidden" name="token" value='.$_SESSION['token'].'>
            <INPUT CLASS="bouton_co_ins" TYPE="SUBMIT" NAME="bouton" value="se desabonner"> 
            </FORM>';
            
        }
        
    }
