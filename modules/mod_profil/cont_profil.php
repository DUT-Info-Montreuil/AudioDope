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

        public function voir_profil() {
            $this->vue->afficher_profil($this->modele->getProfil());
        }

        public function exec() {
            switch($this->action) {
                case 'voir_profil' : $this->voir_profil(); break;
                default : die("action inexistant"); break;
            }
            $this->vue->affichage();
        }
    }
?>