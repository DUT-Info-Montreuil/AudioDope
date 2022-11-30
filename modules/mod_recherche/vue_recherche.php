<?php

if (constant("lala") != "layn")
    die("wrong constant");

include_once('vue_generique.php');

class VueRecherche extends VueGenerique
{

    public function __construct()
    {
        parent::__construct();
    }

    public function menu() {
        echo "<nav class=\"menu\">";
        echo "<a id=\"recherche_post\" href=\"index.php?module=recherche&action=recherche_post&filtre=tout&contenu=$_GET[contenu]\">Posts</a>";
        echo "<a id=\"recherche_user\" href=\"index.php?module=recherche&action=recherche_user&contenu=$_GET[contenu]\">Utilisateurs</a>";
        echo "</nav>";
    }

    public function menu_filtre() {
        echo "<nav class=\"menu\">";
        echo "<a id=\"tout\" href=\"index.php?module=recherche&action=recherche_post&filtre=tout&contenu=$_GET[contenu]\">Tout</a>";
        echo "<a id=\"tag\" href=\"index.php?module=recherche&action=recherche_post&filtre=tag&contenu=$_GET[contenu]\">Tag</a>";
        echo "<a id=\"titre\" href=\"index.php?module=recherche&action=recherche_post&filtre=titre&contenu=$_GET[contenu]\">Titre</a>";
        echo "<a id=\"desc\" href=\"index.php?module=recherche&action=recherche_post&filtre=desc&contenu=$_GET[contenu]\">Description</a>";
        echo "<a id=\"user\" href=\"index.php?module=recherche&action=recherche_post&filtre=user&contenu=$_GET[contenu]\">Utilisateurs</a>";
        echo "</nav>";
    }

    public function indic_recherche($action) {
        echo "<style type=\"text/css\">
            #$action {
            border-radius: 5px;
            color: rgb(255, 252, 249);
            background-color:rgb(53, 45, 57);
            padding-bottom:3px;
        }</style>";
    }

    public function affiche_users($users, $verif_abo) {
       echo "<section id=\"resultat_rech_users\">";
        for($i = 0; $i < count($users); $i++){
           echo '<div class="abo">';
           echo '<div class="pseudo_abo info_list_abo">';
           echo "<div class=\"abonnement_pfp\"><a href=\"index.php?module=profil&action=voir_profil&idUser=".$users[$i]['idUser']."\"><img class=\"class_pfp pfp_list_abo\" src=\"".$users[$i]['pfp']."\" alt=\"photo de profil\"></a></div>";
           echo "<div class=\"abonnement_pseudo\"><a href=\"index.php?module=profil&action=voir_profil&idUser=".$users[$i]['idUser']."\">".$users[$i]['login']."</a></div>";
           echo "</div>";
            if($verif_abo[$i]==2){
               echo '<div class="div_bouton_abo" id="div_bouton_abo'.$users[$i]['idUser'].'">
                <FORM class="form_abonnement" ACTION="javascript/abonnement/desabonner.php" METHOD="POST">
                <input type="hidden" name="token" value='.$_SESSION['token'].'>
                <input type="hidden" name="idUser" value='.$users[$i]['idUser'].'>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                    <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                    <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                </svg>
                <INPUT CLASS="btn btn-primary" TYPE="SUBMIT" NAME="bouton" value="Se désabonner"> 
                </FORM>
                </div>';      
            }else {
               echo '<div class="div_bouton_abo" id="div_bouton_abo'.$users[$i]['idUser'].'">
                <FORM class="form_abonnement" ACTION="javascript/abonnement/abonner.php" METHOD="POST">
                <input type="hidden" name="token" value='.$_SESSION['token'].'>
                <input type="hidden" name="idUser" value='.$users[$i]['idUser'].'>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                    <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                    <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                </svg>
                <INPUT CLASS="btn btn-primary" TYPE="SUBMIT" NAME="bouton" value="S\'abonner"> 
                </FORM>
                </div>';  
            }
           echo "</div>";
           echo "</div>";
        }
       echo "</section>";
    }
}
