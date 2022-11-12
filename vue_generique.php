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
        echo "<article class=\"post\">";
        $this->affiche_post_gauche($post);
        $this->affiche_post_milieu($post);
        $this->affiche_post_droit($post, $vote, $nb_votes);
        echo "</article>";
    }

    public function affiche_post_gauche($post)
    {
        echo "<div class=\"post_gauche\">";
        echo "<a href=\"index.php?module=profil&action=voir_profil&idUser=$post[idUser]\">$post[login]</a>";
        echo "<p><small>$post[datePost]</small></p>";
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
            echo "<a href=\"index.php?module=post&action=voir_post&idPost=$post[idPost]\"><h2 class=\"titre_post\">$post[titre]</h2></a>";
        //description
        echo "<div class=\"div_desc\">";
        if (strcmp($_GET['module'], "post") == 0)
            echo "<p class=\"description\">$post[descriptionPost]</p>";
        else
            echo "<p class=\"description\">" . substr($post['descriptionPost'], 0, 201) . "</p>";
        echo "</div>";
        echo "</div>";
    }

    public function affiche_post_droit($post, $vote, $nb_votes)
    {
        echo "<div class=\"post_droit\">";
        //bouton partage
        echo "<div class=\"options\">";
        echo "<button class=\"options_bouton\" onclick=\"afficher_options(event, $post[idPost])\">...</button>";
        echo "<div class=\"options_contenu\" id=\"options$post[idPost]\">";
        //ajouter collection
        echo "<a href=\"index.php?\">Ajouter à une collection</a>";
        $lien = "index.php?module=post&action=voir_post&idPost=$post[idPost]";
        //partager
        echo "<a onclick=\"partager('$lien')\" href=\"#\">Partager</a>";
        $lien = "index.php?module=post&action=supprimer_post&idPost=$post[idPost]";
        //supprimer
        if (isset($_SESSION['idUser']) && $post['idUser'] == $_SESSION['idUser'])
            echo "<a onclick=\"supprimer('$lien')\" href=\"#\">Supprimer</a>";
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

        if (isset($_SESSION['idUser'])) {
            $onclick_up = "voter($post[idPost], 1)";
            $onclick_down = "voter($post[idPost], -1)";
        } else {
            $onclick_up = "pas_connecte()";
            $onclick_down = "pas_connecte()";
        }
        echo "<a onclick=\"$onclick_up\" href=\"#\"><img id=\"upVote$post[idPost]\" alt=\"fleche upvote\" src=$src_up style=\"width:30px;height:30px;\"></a>";
        echo "<p class=\"nb_vote\" id=\"nb_vote$post[idPost]\">$nb_votes</p>";
        echo "<a onclick=\"$onclick_down\" href=\"#\"><img id=\"downVote$post[idPost]\" alt=\"fleche downvote\" src=$src_down style=\"width:30px;height:30px;\"></a>";
        echo "</div>";

        echo "</div>";
    }
}
?>

<script>
    $(document).click(function() {
        $(".options_contenu").hide();
    });

    function afficher_options(event, idPost) {
        var element = "#options" + idPost;
        if ($(element).is(":visible"))
            $(element).hide();
        else {
            $(".options_contenu").hide();
            $(element).show();
        }
        event.stopPropagation();
    }

    function partager(lien) {
        navigator.clipboard.writeText(lien);
        alert("lien copié");
    }

    function supprimer(lien) {
        if (window.confirm("Êtes-vous sûr de vouloir supprimer ?")) {
            window.open(lien);
        }
    }

    function pas_connecte() {
        if (window.confirm("Connectez ou inscrivez-vous pour pouvoir voter. Souhaitez-vous connecter ?")) {
            window.open("index.php?module=connexion", "_self");
        }
    }

    function voter(id, v) {
        event.preventDefault();
        $.ajax({
            type: 'GET',
            url: 'index.php',
            data: {
                module: "post",
                action: "voter",
                idPost: id,
                vote: v
            },
            success: function(data) {
                var nb_votes = parseInt($('#nb_vote' + id).text());
                if (v == 1) {
                    if ($("#upVote" + id).attr('src') == 'ressources/fleches/fleche_haut_vide.png') {
                        $("#upVote" + id).attr('src', 'ressources/fleches/fleche_haut_plein.png')
                        if ($("#downVote" + id).attr('src') == 'ressources/fleches/fleche_bas_plein.png') {
                            $("#downVote" + id).attr('src', 'ressources/fleches/fleche_bas_vide.png');
                            nb_votes = nb_votes + 2;
                        } else {
                            nb_votes = nb_votes + 1;
                        }
                    } else {
                        $("#upVote" + id).attr('src', 'ressources/fleches/fleche_haut_vide.png');
                        nb_votes = nb_votes - 1;
                    }
                } else {
                    if ($("#downVote" + id).attr('src') == 'ressources/fleches/fleche_bas_vide.png') {
                        $("#downVote" + id).attr('src', 'ressources/fleches/fleche_bas_plein.png')
                        if ($("#upVote" + id).attr('src') == 'ressources/fleches/fleche_haut_plein.png') {
                            $("#upVote" + id).attr('src', 'ressources/fleches/fleche_haut_vide.png');
                            nb_votes = nb_votes - 2;
                        } else {
                            nb_votes = nb_votes - 1;
                        }
                    } else {
                        $("#downVote" + id).attr('src', 'ressources/fleches/fleche_bas_vide.png');
                        nb_votes = nb_votes + 1;
                    }
                }
                $('#nb_vote' + id).text(nb_votes);
            }
        });
    }
</script>