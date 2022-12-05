<?php
/*AudioDope - Version 1.0 - 2022
GNU GPL CopyLeft 2022-2032
Hugo COHEN - Ayoub BOUAZIZ - Steven YANG*/
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