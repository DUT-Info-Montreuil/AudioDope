<?php
// GNU GPL Copyleft 2022 
    if (constant("lala") != "layn")
        die("wrong constant");
        
    include_once('cont_post.php');

    class ModPost {
        public function __construct() {
            $controleur = new ContPost();
            $controleur->exec();
        }
    }
?>