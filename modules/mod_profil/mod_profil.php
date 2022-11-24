<?php

    if (constant("lala") != "layn")
        die("wrong constant");
        
    include_once('cont_profil.php');

    class ModProfil {
        public function __construct() {
            $controleur = new ContProfil();
            $controleur->exec();
        }
    }
?>