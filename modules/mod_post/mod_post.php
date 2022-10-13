<?php
    include_once('cont_post.php');

    class VuePost {
        public function __construct() {
            $controleur = new ContPost();
            $controleur->exec();
        }
    }
?>