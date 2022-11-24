<?php

    if (constant("lala") != "layn")
        die("wrong constant");
        
    include_once('cont_profil.php');

    class ModProfil {
        public function __construct() {
            echo '<script src="javascript/methode_js_profil.js"></script>';
            $controleur = new ContProfil();
            $controleur->exec();
        }
    }
?>