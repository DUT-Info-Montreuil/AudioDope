<?php
/*AudioDope - Version 1.0 - 2022
GNU GPL CopyLeft 2022-2032
Hugo COHEN - Ayoub BOUAZIZ - Steven YANG*/
    session_start();
    header('Content-type: application/json; charset=utf-8');
    
    if (isset($_SESSION['idUser'])) {
        $bdd = new PDO ('mysql:host='."database-etudiants.iut.univ-paris8.fr".';dbname='."dutinfopw201625", "dutinfopw201625", "razamaqe");
        $listeAbonnement = $bdd->prepare('select idUser, login, pfp from Abonner inner join Utilisateurs on (Abonner.idUserAbonnement= Utilisateurs.idUser) where idUserAbonne = ?order by idUser');
        $listeAbonnement->execute(array($_SESSION['idUser']));
        $info = $listeAbonnement->fetchAll();

        $string = "<nav class=\"menu\">
         <a class=\"voir_abonne\" href=\"#\">Abonnés</a>
         <a id=\"nom_liste\" href=\"#\">Abonnements</a>
         </nav>";
        $string = $string."<section id=\"liste_abo\">";
        for($i = 0; $i < count($info); $i++){
            $string = $string.'<div class="abo">';
            $string = $string.'<div class="pseudo_abo info_list_abo">';
            $string = $string."<div class=\"abonnement_pfp\"><a href=\"index.php?module=profil&action=voir_profil&idUser=".$info[$i]['idUser']."\"><img class=\"class_pfp pfp_list_abo\" src=\"".$info[$i]['pfp']."\" alt=\"photo de profil\"></a></div>";
            $string = $string."<div class=\"abonnement_pseudo\"><a href=\"index.php?module=profil&action=voir_profil&idUser=".$info[$i]['idUser']."\">".$info[$i]['login']."</a></div>";
            $string = $string."</div>";
            $string = $string.'<div class="div_bouton_abo" id="div_bouton_abo'.$info[$i]['idUser'].'">
                <FORM class="form_abonnement" ACTION="javascript/abonnement/desabonner.php" METHOD="POST">
                <input type="hidden" name="token" value='.$_SESSION['token'].'>
                <input type="hidden" name="idUser" value='.$info[$i]['idUser'].'>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                    <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                    <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                </svg>
                <INPUT CLASS="btn btn-primary" TYPE="SUBMIT" NAME="bouton" value="Se désabonner"> 
                </FORM>
                </div>';      
            $string = $string."</div>";
            $string = $string."</div>";
        }
        $string = $string."</section>";

        $array = array(
            "string" => $string
        );

        echo json_encode($array);
    }
?>