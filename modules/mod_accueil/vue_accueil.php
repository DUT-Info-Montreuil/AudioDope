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

        public function affiche_posts($posts) {
            echo "<section id=\"posts\">";
            foreach ($posts as &$post) {
                echo "<article class=\"post\">";
                echo "<div class=\"post_gauche\">";
                echo "<a href=\"index.php?module=profil&action=voir_profil&idUser=$post[idUser]\">$post[login]</a>";
                echo "<p><small>$post[datePost]</small></p>";
                echo "<a class=\"lien_musique_post\" href=\"$post[lien]\">lien vers la musique/playlist</a>";
                echo "</div>";
                echo "<div class=\"post_droit\">";
                echo "<h2 class=\"titre_post\">$post[titre]</h2>";
                echo "<div class=\"div_desc\">";
                echo "<p class=\"description\">$post[descriptionPost]</p>";
                echo "</div>";
                echo "</div>";
                echo "</article>";
            }
            echo "</section>";
        }

        public function pas_connecte() {
            echo "Pour voir vos suivis, veuillez vous connecter en cliquant <a href=\"index.php?module=connexion\">ici</a>";
        }
    }
?>