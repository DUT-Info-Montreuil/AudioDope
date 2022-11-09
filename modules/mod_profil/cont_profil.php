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
            $profil = $this->modele->getProfil();
            $this->vue->afficher_profil($profil);
            $val=$this->modele->verif_abonnement($_GET['idUser']);
            if($val==2){
                $this->vue->afficherform_desabonnement($profil['idUser']);               
            }else if($val==1){
                $this->vue->afficherform_abonnement($profil['idUser']);
            }
            $this->vue->afficher_posts_profil($this->modele->getPosts());
        }

        public function exec() {
            switch($this->action) {
                case 'voir_profil' : 
                    $this->voir_profil(); 
                    break;
                case'abonner':
                    $this->abonner();
                    break;
                case'desabonner':
                        $this->desabonner();break;
                case 'afficherAbonner':
                        $this->afficher_abonne();
                    break;
                 case 'afficherAbonnement':
                        $this->afficher_abonnement();
                    break;
                default : die("action inexistant"); break;
            }
            $this->vue->affichage();
        }
    
        public function desabonner(){   
             $this->modele->desabonnement();
             header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
        
        public function abonner(){
            $this->modele->abonnement();
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
        public function afficher_abonne(){
            $this->vue->afficher_listeAbo($this->modele->getAbonne());
        }
        public function afficher_abonnement(){
            $this->vue->afficher_listeAbo($this->modele->getAbonnement());
        }    
    }
