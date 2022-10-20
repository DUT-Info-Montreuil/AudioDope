<?php

    if (constant("lala") != "layn")
        die("wrong constant");

    include_once('vue_generique.php');

    class VueAccueil extends VueGenerique {
        
        public function __construct() {
            parent::__construct();
        }

        public function menu() {
            echo "<nav id=\"menu\">";
            echo "<a id=\"recommandes\" href=\"index.php?module=accueil&action=recommandes\">Recommandés</a>";
            echo "<a id=\"decouverte\" href=\"index.php?module=accueil&action=decouverte\">Découverte</a>";
            echo "<a id=\"suivis\" href=\"index.php?module=accueil&action=suivis\">Suivis</a>";
            echo "<a id=\"tendance\" href=\"index.php?module=accueil&action=tendance\">Tendance</a>";
            echo "<a id=\"recent\" href=\"index.php?module=accueil&action=recent\">Récent</a>";
            echo "</nav>";
        }

        public function indic_section($action) {
            echo "<style type=\"text/css\">
                #$action {
                color: white;
                background-color: black;
            }</style>";
        }

        public function affiche_recent($posts) {
            foreach ($posts as &$post) {
                echo "<article>";
                echo "<h2>$post[titre]</h2>";
                echo "<p><a href=\"index.php?module=profil&action=voir_profil&idUser=$post[idUser]\">$post[login]</a>&nbsp;<small>$post[datePost]</small></p>";
                echo "<a class=\"lien_musique_post\" href=\"$post[lien]\">lien vers la musique/playlist</a>";
                echo "<p>$post[descriptionPost]</p>";
                echo "</article>";
            }
        }
    }
?>