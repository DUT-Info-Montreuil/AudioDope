<?php
// GNU GPL Copyleft 2022 
    if (constant("lala") != "layn")
        die("wrong constant");

    include_once('cont_presentation.php');

    class ModPresentation {

        public function __construct() {
            $controleur = new ContPresentation();
        }
    }
?>