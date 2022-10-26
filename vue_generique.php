<?php

    if (constant("lala") != "layn")
        die("wrong constant");

    class VueGenerique {

        public function __construct() {
            ob_start();
        }    

        public function  getAffichage() {
            return ob_get_clean();
        }

        public function affichage() {
            global $affichage;
            $affichage = $this->getAffichage();
        }

        public function nonConnecte() {
            echo "<p>Vous n'êtes pas connecté</p>";
        }

        public function deja_connecte() {
            $login = htmlspecialchars($_SESSION['login']);
            echo "<p>Vous êtes déjà connecté sous l’identifiant $login</p> <br> <a href=\"index.php?module=connexion&action=deconnexion\">Se déconnecter</a>";
        }

        public function affiche_posts($posts) {
            echo "<section id=\"posts\">";
            foreach ($posts as &$post) {
                echo "<article class=\"post_dans_section\">";
                echo "<div class=\"post_gauche\">";
                echo "<a href=\"index.php?module=profil&action=voir_profil&idUser=$post[idUser]\">$post[login]</a>";
                echo "<p><small>$post[datePost]</small></p>";
                echo "<a class=\"lien_musique_post\" href=\"$post[lien]\">lien vers la musique/playlist</a>";
                echo "</div>";
                echo "<div class=\"post_droit\">";
                echo "<h2 class=\"titre_post\">$post[titre]</h2>";
                echo "<div class=\"div_desc\">";
                echo "<p class=\"description\">".substr($post['descriptionPost'], 0, 199)."<a href=\"index.php?module=post&action=voir_post&idPost=$post[idPost]\">...</a></p>";
                echo "</div>";
                echo "</div>";
                echo "</article>";
            }
            echo "</section>";
        }

        public function affiche_post($post) {
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
    }
?>