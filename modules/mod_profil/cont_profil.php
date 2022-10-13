<?php


    if (constant("lala") != "layn")
        die("wrong constant");

    include_once('modele_profil.php');
    include_once('vue_profil.php');
    
    class ContProfil {

        private $modele;
        private $vue;
        private $action;

        public function __construct() {
            $this->modele = new ModeleProfil();
            $this->vue = new VueProfil();
            $this->action = isset($_GET['action']) ? $_GET['action'] : "";
        }

        public function exec() {
            switch($this->action) {
                case "visite_perso" : $this->visite_profil(); break;
                default : die("action inexistant"); break;
            }
            $this->vue->affichage();
        }
    }
?>