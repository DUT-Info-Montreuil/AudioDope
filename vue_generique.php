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

        public function non_connecte() {
            echo "<p>Vous n'êtes pas connecté. Pour vous connecter, cliquer <a href=\"index.php?module=connexion\">ici</a></p>";
        }

        public function deja_connecte() {
            $login = htmlspecialchars($_SESSION['login']);
            echo "<p>Vous êtes déjà connecté sous l’identifiant $login</p> <br> <a href=\"index.php?module=connexion&action=deconnexion\">Se déconnecter</a>";
        }

        public function affiche_posts($posts) {
            echo "<section id=\"posts\">";
            foreach ($posts as &$post) {
                $this->affiche_post($post);
            }
            echo "</section>";
        }

        public function affiche_post($post) {
            echo "<article class=\"post\">";
            //partie gauche
            echo "<div class=\"post_gauche\">";
            echo "<a href=\"index.php?module=profil&action=voir_profil&idUser=$post[idUser]\">$post[login]</a>";
            echo "<p><small>$post[datePost]</small></p>";
            echo "<a class=\"lien_musique_post\" href=\"$post[lien]\">lien vers la musique/playlist</a>";
            echo "</div>";
            //partie droite
            echo "<div class=\"post_droit\">";
            //titre
            if (strcmp($_GET['module'], "post") == 0)
                echo "<h2 class=\"titre_post\">$post[titre]</h2>";
            else
                echo "<a href=\"index.php?module=post&action=voir_post&idPost=$post[idPost]\"><h2 class=\"titre_post\">$post[titre]</h2></a>";
            //description
            echo "<div class=\"div_desc\">";
            if (strcmp($_GET['module'], "post") == 0)
                echo "<p class=\"description\">$post[descriptionPost]</p>";
            else 
                echo "<p class=\"description\">".substr($post['descriptionPost'], 0, 201)."</p>";
            echo "</div>";
            echo "</div>";
            echo 
            " <div class=\"options\">
                <button class=\"options_bouton\">...</button>
                <div class=\"options_contenu\">
                    <a href=\"index.php?\">Ajouter à une collection</a>";
            //bouton partage
            $lien = "index.php?module=post&action=voir_post&idPost=$post[idPost]";
            echo "<a onclick=\"partager('$lien')\" href=\"#\">Partager</a>";
            $lien = "index.php?module=post&action=supprimer_post&idPost=$post[idPost]";
            if (isset($_SESSION['idUser']) && $post['idUser'] == $_SESSION['idUser'])
                //echo "<a href=\"index.php?module=post&action=supprimer_post&idPost=$post[idPost]\">Supprimer</a>";
                echo "<a onclick=\"supprimer('$lien')\" href=\"#\">Supprimer</a>";
            echo "</div></div>";
            echo "</article>";
            if (strcmp($_GET['module'], "post") == 0) {
                echo '<h3 id="titre_rouge">Commentaires</h3>
                <FORM ACTION="index.php?module=post&action=redaction_commentaire&idPost=' . $_GET['idPost'] . '" METHOD="POST" id="form_redac"> </br>
                    <div class="mb-3">
                        <TEXTAREA class="form-control" NAME="avis_commentaire" placeholder="Laissez votre avis!" MAXLENGTH="1000" rows="5"></textarea>
                    </div> </br>
                    <INPUT CLASS="btn btn-primary" TYPE="SUBMIT" NAME="bouton" value="Envoyer"> 
                </FORM>';
            }
        }
    }
?>

<script>
function partager(lien) {
  // Copy the text inside the text field
  navigator.clipboard.writeText(lien);
  alert("lien copié");
}

function supprimer(lien) {
    if (window.confirm("Êtes-vous sûr de vouloir supprimer ?")) {
        window.open(lien);
}

}
</script>

