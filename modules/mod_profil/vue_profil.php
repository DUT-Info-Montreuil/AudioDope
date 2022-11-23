<?php

    if (constant("lala") != "layn")
        die("wrong constant");

    include_once('vue_generique.php');

    class VueProfil extends VueGenerique {
        
        public function __construct() {
            parent::__construct();
        }

        public function afficher_profil($profil) {
            echo '<div id="profil">';
            echo '<div id="profil_gauche">';
            if(isset($_SESSION['idUser']) && $profil['idUser'] == $_SESSION['idUser']) {
                echo "<a id=\"lien_pfp\" href=\"#\"><img src=\"$profil[pfp]\" alt=\"photo de profil\" width=\"64\" height=\"64\"></a>";
            } else {
                echo "<img src=\"$profil[pfp]\" alt=\"photo de profil\" width=\"64\" height=\"64\">";
            }
            echo '<p>'.$profil['login'].'</p>';
            echo '</div>';
            echo '<div id="profil_droit">';
            if(isset($_SESSION['idUser']) && $profil['idUser'] == $_SESSION['idUser']) {
                echo "<div id=\"abonne\"><p>$profil[nb_abonnes]</p><p><a href=\"index.php?module=profil&action=afficherAbonner&id=".$_SESSION['idUser']."\">Abonne(s)</a></p></div>";
                echo "<div id=\"abonnenement\"><p>$profil[nb_abonnement]</p><p><a href=\"index.php?module=profil&action=afficherAbonnement&id=".$_SESSION['idUser']."\">Abonnement(s)</a></p></div>";
            } else {
                echo "<div id=\"abonne\"><p>$profil[nb_abonnes]</p><p>Abonne(s)</p></div>";
                echo "<div id=\"abonnenement\"><p>$profil[nb_abonnement]</p><p>Abonnement(s)</p></div>";
            }
            echo '</div>';
            echo '</div>';
            
            //pop up changer de pfp
            echo '<div id="myModal" class="modal">
                    <div class="modal-content">
                        <FORM id="form_pfp" action="" METHOD="POST"> 
                        <input type="hidden" name="idUser" value='.$_SESSION['idUser'].'>
                        <input type="file" name="input_pfp" accept="image/png, image/gif, image/jpeg"/>
                        <INPUT TYPE="SUBMIT" NAME="bouton" value="Valider"> 
                        </FORM>
                    </div>
                </div>';
        }

        public function afficher_listeAbo($array) {
            for($i = 0; $i < count($array['info']); $i++){
                echo "<div class=\"abo\"><a href=\"index.php?module=profil&action=voir_profil&idUser=".$array['info'][$i]['idUser']."\">".$array['info'][$i]['login']."</a>";
                if($array['abo'][$i]==2){
                    $this->afficherform_desabonnement($array['info'][$i]['idUser']);               
                }else if($array['abo'][$i]==1){
                    $this->afficherform_abonnement($array['info'][$i]['idUser']);
                }
                echo "</div>";
            }
        }

        public function afficherform_abonnement($idUser){
            echo '<FORM ACTION="index.php?module=profil&action=abonner&idUser='.$idUser.'" METHOD="POST"> 
            <input type="hidden" name="token" value='.$_SESSION['token'].'>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
            </svg>
            <INPUT CLASS="btn btn-primary" TYPE="SUBMIT" NAME="bouton" value="S\'abonner"> 
            </FORM>';
        }
        
        public function afficherform_desabonnement($idUser){
            echo '<FORM ACTION="index.php?module=profil&action=desabonner&idUser='.$idUser.'" METHOD="POST"> 
            <input type="hidden" name="token" value='.$_SESSION['token'].'>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
            </svg>
            <INPUT CLASS="btn btn-primary" TYPE="SUBMIT" NAME="bouton" value="Se désabonner"> 
            </FORM>';
            
        }
        
        public function afficher_posts_profil($posts) {
            echo "<h2 id=\"titre_posts_profil\">Posts</h2>";
            $this->affiche_posts($posts);
        }
    }
