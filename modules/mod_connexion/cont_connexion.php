<?php


    if (constant("lala") != "layn")
        die("wrong constant");

    include_once('modele_connexion.php');
    include_once('vue_connexion.php');
    
    class ContConnexion {

        private $modele;
        private $vue;
        private $action;

        public function __construct() {
            $this->modele = new ModeleConnexion();
            $this->vue = new VueConnexion();
            $this->action = isset($_GET['action']) ? $_GET['action'] : "form_connexion";
        }
        
        public function form_inscription() {
            $this->modele->creation_token();
            $this->vue->form_inscription();
        }

        public function inscription() {
            $confirmation = $this->modele->inscription();
            if ($confirmation != null) {
                if ($confirmation == 1)
                    $this->vue->session_expiree();
                else
                    header("Location: index.php?module=connexion&action=form_inscription&erreur=$confirmation");
            } else {
                $this->vue->confirmation_inscription();
            }
        }

        public function form_connexion() {
            if (isset($_SESSION['login'])) {
                $this->vue->deja_connecte();
            } else {
                $this->modele->creation_token();
                $this->vue->form_connexion();
            }
            
        }

        public function connexion() {
            $confirmation = $this->modele->connexion();
            if ($confirmation != null) {
                if ($confirmation == 1) {
                    $this->vue->session_expiree();
                } else if ($confirmation == 2) {
                    $this->vue->deja_connecte();
                } else {
                    header("Location: index.php?module=connexion&action=form_connexion&erreur=null");
                }
            } else {
                $this->vue->confirmation_connexion();
            }
        }

        public function deconnexion() {
            $this->modele->deconnexion();
            $this->vue->confirmation_deconnexion();
        }

        public function exec() {
            switch($this->action) {
                case "form_inscription" : $this->form_inscription(); break;
                case "inscription" : $this->inscription(); break;
                case "form_connexion" : $this->form_connexion(); break;
                case "connexion" : $this->connexion(); break;
                case "deconnexion" : $this->deconnexion(); break;
                default : die("module inexistant"); break;
            }
            if (strcmp($this->action,"form_connexion") == 0 && !isset($_SESSION['login'])) {
                $this->vue->menu();
            }
            $this->vue->affichage();
        }
    }
?>