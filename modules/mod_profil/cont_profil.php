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
            if (isset($_SESSION['idUser']) && $_GET['idUser'] == $_SESSION['idUser'])
                echo '<script src="javascript/profil/methode_js_profil.js"></script>
                    <script src="javascript/abonnement/methode_js_abo.js"></script>';

            $profil = $this->modele->getProfil();
            $this->vue->afficher_profil($profil);
            $val=$this->modele->verif_abonnement($_GET['idUser']);
            if($val==2){
                $this->vue->afficherform_desabonnement($profil['idUser']);               
            }else if($val==1){
                $this->vue->afficherform_abonnement($profil['idUser']);
            }

            $posts = $this->modele->get_posts();
            $votes  = $this->modele->get_votes($posts);
            $nb_votes = $this->modele->get_nb_votes($posts, 0);
            $tags = $this->modele->get_tags($posts);
            $aimer_tags = $tags;
            $this->vue->afficher_posts_profil($posts, $votes, $nb_votes, $tags, $aimer_tags);
        }

        public function exec() {
            switch($this->action) {
                case 'voir_profil' : 
                    $this->voir_profil(); 
                    break;
                default : die("action inexistant");
            }
            $this->vue->affichage();
        }
    }
