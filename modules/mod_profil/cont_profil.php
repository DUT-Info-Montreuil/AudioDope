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
            $val=$this->modele->verif_abonnement();
            if($val==2){
                $this->vue->afficherform_desabonnement($this->modele->getProfil());               
            }else if($val==1){
                $this->vue->afficherform_abonnement($this->modele->getProfil());
            }
            $this->vue->afficher_posts_profil($this->modele->getPosts());
            $this->vue->affiche_collections($this->modele->getCollection());
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
             header("Location: index.php?module=profil&action=voir_profil&idUser=".$_GET['idUser']);
        }
        
        public function abonner(){
            $this->modele->abonnement();
            header("Location: index.php?module=profil&action=voir_profil&idUser=".$_GET['idUser']);
        }
        public function afficher_abonne(){
            $this->vue->afficher_listeAbonne($this->modele->getAbonne());
        }
        public function afficher_abonnement(){
            $this->vue->afficher_listeAbonnement($this->modele->getAbonnement());
        }
         
            
            
    }
