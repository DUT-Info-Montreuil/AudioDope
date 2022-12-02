<?php
// GNU GPL Copyleft 2022 
    if (constant("lala") != "layn")
        die("wrong constant");
        
    include_once('cont_recherche.php');

    class ModRecherche {
        public function __construct() {
            $controleur = new ContRecherche();
            $controleur->exec();
        }
    }
?>