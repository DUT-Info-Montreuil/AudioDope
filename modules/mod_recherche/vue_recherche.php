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
        echo "<nav id=\"menu\">";
        echo "<a id=\"section_tout\" href=\"index.php?module=recherche&action=section_tout&contenu=$_GET[contenu]\">Tout</a>";
        echo "<a id=\"section_tag\" href=\"index.php?module=recherche&action=section_tag&contenu=$_GET[contenu]\">Tag</a>";
        echo "<a id=\"section_titre\" href=\"index.php?module=recherche&action=section_titre&contenu=$_GET[contenu]\">Titre</a>";
        echo "<a id=\"section_desc\" href=\"index.php?module=recherche&action=section_desc&contenu=$_GET[contenu]\">Description</a>";
        echo "<a id=\"section_user\" href=\"index.php?module=recherche&action=section_user&contenu=$_GET[contenu]\">Utilisateurs</a>";
        echo "</nav>";
    }

    public function indic_section($action) {
        echo "<style type=\"text/css\">
            #$action {
            border-radius: 5px;
            color: rgb(255, 252, 249);
            background-color:rgb(53, 45, 57);
            padding-bottom:3px;
        }</style>";
    }
}
