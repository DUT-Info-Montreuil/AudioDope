<?php

    if (constant("lala") != "layn")
        die("wrong constant");

    include_once('vue_generique.php');

    class VueProfil extends VueGenerique {
        
        public function __construct() {
            parent::__construct();
        }

        public function afficher_profil($profil) {
            echo $_GET['login']."<br/>".$profil['nb_abonnes']." abonnés  ".$profil['nb_abonnement']." abonnements";
        }
    }
?>