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
    }
?>