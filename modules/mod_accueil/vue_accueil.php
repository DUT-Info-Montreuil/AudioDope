<?php
// GNU GPL Copyleft 2022 
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

        public function aucun_abonnement() {;
            echo "<p>Aucun de vos abonnements n'a poster<p>";
        }

        public function pas_de_post_en_tendance() {
            echo "<p> Aucun post n'a atteinds les tendances durant les septièmes derniers jours ... </p>
            <a href=\"index.php?module=post&action=form_redaction\">Cliquez ici pour en rédiger  et tenter d'arriver en tendance!</a>";
        }

    }
?>