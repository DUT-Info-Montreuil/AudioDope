<?php

    if (constant("lala") != "layn")
        die("wrong constant");

    include_once('vue_generique.php');

    class VueProfil extends VueGenerique {
        
        public function __construct() {
            parent::__construct();
        }
        
    }
?>