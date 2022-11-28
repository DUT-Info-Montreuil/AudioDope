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
        echo "<a id=\"section_tout\" href=\"index.php?module=recherche&action=section_tout\">Tout</a>";
        echo "<a id=\"section_tag\" href=\"index.php?module=recherche&action=section_tag\">Tag</a>";
        echo "<a id=\"section_titre\" href=\"index.php?module=recherche&action=section_titre\">Titre</a>";
        echo "<a id=\"section_user\" href=\"index.php?module=recherche&action=section_user\">Utilisateurs</a>";
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
