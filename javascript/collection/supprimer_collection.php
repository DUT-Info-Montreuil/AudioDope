<?php
    /*AudioDope - Version 1.0 - 2022
GNU GPL CopyLeft 2022-2032
Hugo COHEN - Ayoub BOUAZIZ - Steven YANG*/
    session_start();
    if (isset($_SESSION['idUser'])) {
        $bdd = new PDO ('mysql:host='."database-etudiants.iut.univ-paris8.fr".';dbname='."dutinfopw201625", "dutinfopw201625", "razamaqe");
        $idUser = $bdd->prepare('select idUser from Collections where idCollection = ?');
        $idUser->execute(array($_GET['idCollection']));
        if ($idUser->fetch()['idUser'] == $_SESSION['idUser']) {
            $post = $bdd->prepare('delete from Collections where idCollection = ?');
            $post->execute(array($_GET['idCollection']));
        }
    }
?>