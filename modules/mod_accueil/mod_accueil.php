<?php

    if (constant("lala") != "layn")
        die("wrong constant");
        
    include_once('cont_accueil.php');

    class ModAccueil {
        public function __construct() {
            $controleur = new ContAccueil();
            $controleur->exec();
        }
    }
?>