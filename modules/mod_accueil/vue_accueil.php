<?php

    if (constant("lala") != "layn")
        die("wrong constant");

    include_once('vue_generique.php');

    class VueAccueil extends VueGenerique {
        
        public function __construct() {
            parent::__construct();
        }

        public function menu() {
            echo "<a href=\"index.php?module=\">Recommandés</a>";
            echo "<a href=\"index.php?module=\">Découverte</a>";
            echo "<a href=\"index.php?module=\">Suivis</a>";
            echo "<a href=\"index.php?module=\">Tendance</a>";
            echo "<a href=\"index.php?module=\">Récent</a>";
            echo "<br/>";
        }
    }
?>