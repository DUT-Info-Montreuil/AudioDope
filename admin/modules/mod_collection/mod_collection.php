<?php
    /*AudioDope - Version 1.0 - 2022
GNU GPL CopyLeft 2022-2032
Hugo COHEN - Ayoub BOUAZIZ - Steven YANG*/
    if (constant("lala") != "layn")
        die("wrong constant");
        
    include_once('cont_collection.php');

    class ModCollection {
        public function __construct() {
            $controleur = new ContCollection();
            $controleur->exec();
        }
    }
?>