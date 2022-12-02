<?php
// GNU GPL Copyleft 2022 
    if (constant("lala") != "layn")
        die("wrong constant");
        
    include_once('cont_connexion.php');

    class ModConnexion {
        public function __construct() {
            $controleur = new ContConnexion();
            $controleur->exec();
        }
    }
?>