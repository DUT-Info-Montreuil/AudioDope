<?php

    if (constant("lala") != "layn")
        die("wrong constant");

    include_once('vue_generique.php');

    class VueProfil extends VueGenerique {
        
        public function __construct() {
            parent::__construct();
        }

        public function afficher_profil($profil) {
            echo "<div id =\"pseudo\">".$profil['login']."</div><div id=\"abo\"><p>".$profil['nb_abonnes']." abonnés</p><p>".$profil['nb_abonnement']." abonnements</p></div>";
        }
    }
?>