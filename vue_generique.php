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
                <div class=\"options_contenu\">";
            //bouton ajouter a une collection
            $lien = "index.php?module=collection&action=choix_collection";
             echo" <a onclick=\"Ajouter à une collection('$lien')\" href=\"index.php?module=collection&action=choix_collection\">Ajouter à une collection</a>";
            //bouton partage
            $lien = "index.php?module=post&action=voir_post&idPost=$post[idPost]";
            echo "<a onclick=\"partager('$lien')\" href=\"#\">Partager</a>";
            $lien = "index.php?module=post&action=supprimer_post&idPost=$post[idPost]";
            if (isset($_SESSION['idUser']) && $post['idUser'] == $_SESSION['idUser'])
                //echo "<a href=\"index.php?module=post&action=supprimer_post&idPost=$post[idPost]\">Supprimer</a>";
                echo "<a onclick=\"supprimer('$lien')\" href=\"#\">Supprimer</a>";
            echo "</div></div>";
            echo "</article>";
        }
    

    public function affiche_collections($collection) {
        echo "<section id=\"collection\">";
        foreach ($collection as &$collection) {
    
            $this->affiche_collection($collection);
        }
        echo "</section>";
    }

    public function affiche_collection($collection){
        echo "<article class=\"collection\">";
            //partie gauche
            echo "<div class=\"collection_gauche\">";
           
            echo "<a href=\"index.php?module=profil&action=voir_profil&idUser=$collection[idUser]\">$collection[login]</a>";
            echo "</div>";
            //partie centrale
            echo "<div class=\"collection_centrale\">";
            //titre
            if (strcmp($_GET['module'], "collection") == 0){
                echo "<h2 class=\"titre_collection\">$collection[titre]</h2>";
           
            }else
                echo "<a href=\"index.php?module=collection&action=voir_collection&idCollection=$collection[idCollection]\"><h2 class=\"titre_collection\">$collection[titreCollection]</h2></a>";    
            //description
            echo "<div class=\"div_descCollection\">";
            if (strcmp($_GET['module'], "collection") == 0)
                echo "<p class=\"descriptionC\">$collection[descriptionCollection]</p>";
            else 
                echo "<p class=\"descriptionC\">".substr($collection['descriptionCollection'], 0, 201)."</p>";
            echo "</div>";
            echo "</div>";
            
           
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

