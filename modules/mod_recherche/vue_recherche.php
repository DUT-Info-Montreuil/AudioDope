<?php

if (constant("lala") != "layn")
    die("wrong constant");

include_once('vue_generique.php');

class VueRecherche extends VueGenerique
{

    public function __construct()
    {
        parent::__construct();
    }

    public function menu() {
        echo "<nav class=\"menu\">";
        echo "<a id=\"recherche_post\" href=\"index.php?module=recherche&action=recherche_post&filtre=tout&contenu=$_GET[contenu]\">Posts</a>";
        echo "<a id=\"recherche_user\" href=\"index.php?module=recherche&action=recherche_user&contenu=$_GET[contenu]\">Utilisateurs</a>";
        echo "</nav>";
    }

    public function menu_filtre() {
        echo "<nav class=\"menu\">";
        echo "<a id=\"tout\" href=\"index.php?module=recherche&action=recherche_post&filtre=tout&contenu=$_GET[contenu]\">Tout</a>";
        echo "<a id=\"tag\" href=\"index.php?module=recherche&action=recherche_post&filtre=tag&contenu=$_GET[contenu]\">Tag</a>";
        echo "<a id=\"titre\" href=\"index.php?module=recherche&action=recherche_post&filtre=titre&contenu=$_GET[contenu]\">Titre</a>";
        echo "<a id=\"desc\" href=\"index.php?module=recherche&action=recherche_post&filtre=desc&contenu=$_GET[contenu]\">Description</a>";
        echo "<a id=\"user\" href=\"index.php?module=recherche&action=recherche_post&filtre=user&contenu=$_GET[contenu]\">Utilisateurs</a>";
        echo "</nav>";
    }

    public function indic_recherche($action) {
        echo "<style type=\"text/css\">
            #$action {
            border-radius: 5px;
            color: rgb(255, 252, 249);
            background-color:rgb(53, 45, 57);
            padding-bottom:3px;
        }</style>";
    }
}
