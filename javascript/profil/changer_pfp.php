<?php
// GNU GPL Copyleft 2022 
    session_start();
    header('Content-type: application/json; charset=utf-8');

    $bdd = new PDO ('mysql:host='."database-etudiants.iut.univ-paris8.fr".';dbname='."dutinfopw201625", "dutinfopw201625", "razamaqe");
    
    $tailleMax = 1500000;

    if ($_FILES['file_pfp']['error'] > 0) {
        $array = array(
            "erreur" => "Erreur de transfert"
        );
    } else if ($_FILES['file_pfp']['size'] > $tailleMax) {
        $array = array(
            "erreur" => "Fichier trop lourd"
        );
    } else {
        $extensionFichier = "." . strtolower(substr(strrchr($_FILES['file_pfp']['name'], '.'), 1));
        $destination  = "../../ressources/pfp/" . $_SESSION['idUser'] . $extensionFichier;
        
        $chemin_pfp = $bdd->prepare('select pfp from Utilisateurs where idUser = ?');
        $chemin_pfp->execute(array($_SESSION['idUser']));
        $chemin_pfp = $chemin_pfp->fetch()['pfp'];
        if ($chemin_pfp != 'ressources/pfp/pfp.jpg')
            unlink("../../$chemin_pfp");


        $chemin_pfp = "ressources/pfp/$_SESSION[idUser]$extensionFichier";
        $modif_pfp = $bdd->prepare('update Utilisateurs set pfp = ? where idUser = ?');
        $modif_pfp->execute(array($chemin_pfp, $_SESSION['idUser']));
        
        move_uploaded_file($_FILES['file_pfp']['tmp_name'], $destination);
            
        $array = NULL;
}
    echo json_encode($array);
?>