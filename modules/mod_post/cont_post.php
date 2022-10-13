<?php
    include_once('modele_post.php');
    include_once('vue_post.php');
    
    class ContPost {

        private $modele;
        private $vue;
        private $action;

        public function __construct() {
            $this->modele = new ModelePost();
            $this->vue = new VuePost();
            $this->action = isset($_GET['action']) ? $_GET['action'] : "form_connexion";
        }

        public function exec() {

        }
        
    }
?>