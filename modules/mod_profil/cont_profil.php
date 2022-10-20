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
                case 'voir_profil' : $this->voir_profil();  $this->form_abonnement();  break;
                
                case'abonner':

                    $this->abonner();break;
                default : die("action inexistant"); break;
            }
            $this->vue->affichage();
        }
    
        public function form_abonnement(){
            $this->vue->afficherform_abonnement($this->modele->getProfil());
    
        }
        public function abonner(){
           
            $val=$this->modele->verif_abonnement();
           if($val==1){
            $this->vue->afficherform_abonnement($this->modele->getProfil());
            $this->modele->abonnement();
            header("Location: index.php?module=profil&action=voir_profil&idUser=".$_GET['idUser']);
            }else{
                header("Location: index.php?module=profil&action=voir_profil&idUser=".$_GET['idUser']);
            }
         
            
            
    }
    }

?>