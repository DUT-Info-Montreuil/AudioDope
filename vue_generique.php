<?php

if (constant("lala") != "layn")
    die("wrong constant");

class VueGenerique
{

    public function __construct()
    {
        ob_start();
    }

    public function  getAffichage()
    {
        return ob_get_clean();
    }

    public function affichage()
    {
        global $affichage;
        $affichage = $this->getAffichage();
    }

    public function non_connecte()
    {
        echo "<p>Vous n'êtes pas connecté. Pour vous connecter, cliquer <a href=\"index.php?module=connexion\">ici</a></p>";
    }

    public function deja_connecte()
    {
        $login = htmlspecialchars($_SESSION['login']);
        echo "<p>Vous êtes déjà connecté sous l’identifiant $login</p> <br> <a href=\"index.php?module=connexion&action=deconnexion\">Se déconnecter</a>";
    }

    public function affiche_posts($posts)
    {
        echo "<section id=\"posts\">";
        for ($i = 0; $i < count($posts['posts']); $i++) {
            $this->affiche_post($posts['posts'][$i], $posts['votes'][$i], $posts['nb_votes'][$i]);
        }
        echo "</section>";
    }

    public function affiche_post($post, $vote, $nb_votes)
    {
        echo "<div class=\"post\" id=\"$post[idPost]\">";
        $this->affiche_post_gauche($post);
        $this->affiche_post_milieu($post);
        $this->affiche_post_droit($post, $vote, $nb_votes);
        echo "<a href=\"index.php?module=post&action=voir_post&idPost=$post[idPost]\"> <span class=\"lien_vers_post\"></span></a></div>";
    }

    public function affiche_post_gauche($post)
    {
        echo "<div class=\"post_gauche\">";
        echo "<div class=\"post_gauche_haut\">";
        echo "<div class=\"post_pfp\">";
        echo "<img class=\"class_pfp\" src=\"$post[pfp]\" alt=\"photo de profil\">";
        echo "</div>";
        echo "<div class=\"post_nom_date\">";
        echo "<a href=\"index.php?module=profil&action=voir_profil&idUser=$post[idUser]\">$post[login]</a>";
        echo "<p><small>".substr($post['datePost'], 11)."</small></br>";
        echo "<small>".substr($post['datePost'], 0, 10)."</small></p>";
        echo "</div>";
        echo "</div>";
        echo "<a class=\"lien_musique_post\" href=\"$post[lien]\">lien vers la musique/playlist</a>";
        echo "</div>";
    }

    public function affiche_post_milieu($post)
    {
        echo "<div class=\"post_milieu\">";
        //titre
        if (strcmp($_GET['module'], "post") == 0)
            echo "<h2 class=\"titre_post\">$post[titre]</h2>";
        else
            echo "<h2 class=\"titre_post\">$post[titre]</h2>";
        //description
        echo "<div class=\"div_desc\">";
        if (strcmp($_GET['module'], "post") == 0)
            echo "<p class=\"description\">$post[descriptionPost]</p>";
        else
            echo "<p class=\"description\">" . substr($post['descriptionPost'], 0, 201) . "</p>";
        echo "</div>";
        echo "</div>";
    }

    public function affiche_post_droit($post, $vote, $nb_votes) {
        echo "<div class=\"post_droit\">";
        //bouton partage
        echo "<div class=\"options\">";
        echo "<button class=\"options_bouton\" idPost=$post[idPost]>...</button>";
        echo "<div class=\"options_contenu\" id=\"options$post[idPost]\">";
        //ajouter collection
        echo "<a href=\"index.php?\">Ajouter à une collection</a>";
        $lien = "index.php?module=post&action=voir_post&idPost=$post[idPost]";
        //partager
        echo "<a class=\"partager\" lien=\"$lien\" href=\"#\">Partager</a>";
        //supprimer
        if (isset($_SESSION['idUser']) && $post['idUser'] == $_SESSION['idUser'])
            echo "<a class=\"supprimer\" idPost=$post[idPost] href=\"#\">Supprimer</a>";
        echo "</div>";
        echo "</div>";
        
        //vote
        echo "<div class=\"vote\">";
        if ($vote == 0) {
            $src_up = "ressources/fleches/fleche_haut_vide.png";
            $src_down = "ressources/fleches/fleche_bas_vide.png";
        } else if ($vote == 1) {
            $src_up = "ressources/fleches/fleche_haut_plein.png";
            $src_down = "ressources/fleches/fleche_bas_vide.png";
        } else {
            $src_up = "ressources/fleches/fleche_haut_vide.png";
            $src_down = "ressources/fleches/fleche_bas_plein.png";
        }

        echo "<a class=\"voter\" id=\"UpVote$post[idPost]\" idPost=$post[idPost] vote=1 href=\"#\"><img id=\"imgUpVote$post[idPost]\" alt=\"fleche upvote\" src=$src_up style=\"width:30px;height:30px;\"></a>";
        echo "<p class=\"nb_vote\" id=\"nb_vote$post[idPost]\">$nb_votes</p>";
        echo "<a class=\"voter\" id=\"DownVote$post[idPost]\" idPost=$post[idPost] vote=-1 href=\"#\"><img id=\"imgDownVote$post[idPost]\" alt=\"fleche downvote\" src=$src_down style=\"width:30px;height:30px;\"></a>";
        echo "</div>";

        echo "</div>";
    }
    
    public function affiche_redac_commentaire() {
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

    public function affiche_commentaire($com) {
        echo "<article class=\"post\">";
        //partie gauche
        echo "<div class=\"post_gauche_com\">";
        echo "<div class=\"post_pfp\">";
        echo "<img class=\"class_pfp\" src=\"$com[pfp]\" alt=\"photo de profil\">";
        echo "</div>";
        echo "<div class=\"post_nom_date\">";
        echo "<a href=\"index.php?module=profil&action=voir_profil&idUser=$com[idUser]\">$com[login]</a>";
        echo "<p><small>".substr($com['dateCom'], 11)."</small></br>";
        echo "<small>".substr($com['dateCom'], 0, 10)."</small></p>";
        echo "</div>";
        echo "</div>";
        //partie droite
        echo "<div class=\"post_milieu\">";
        //description
        echo "<div class=\"div_desc\">";
        echo "<p class=\"description\">$com[avis]</p>";
        echo "</div>";
        echo "</div>";
        echo "</div></div>";
        echo "</article>";
    }
    
}
?>