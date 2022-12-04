<?php

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