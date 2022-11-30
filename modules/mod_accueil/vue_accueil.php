<?php

    if (constant("lala") != "layn")
        die("wrong constant");

    include_once('vue_generique.php');

    class VueAccueil extends VueGenerique {
        
        public function __construct() {
            parent::__construct();
        }

        public function menu() {
            echo "<nav class=\"menu\">";
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
                border-radius: 5px;
                color: rgb(255, 252, 249);
                background-color:rgb(53, 45, 57);
                padding-bottom:3px;
            }</style>";
        }

        public function aucun_abonnement() {;
            echo "<p>Vous n'avez aucun abonnement<p>";
        }

        public function pas_de_post_en_tendance() {
            echo "<p> Aucun post n'a atteinds les tendances durant les septièmes derniers jours ... </p>
            <a href=\"index.php?module=post&action=form_redaction\">Cliquez ici pour en rédiger  et tenter d'arriver en tendance!</a>";
        }

    }
?>