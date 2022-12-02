<?php
// GNU GPL Copyleft 2022 
    session_start();
    if (isset($_SESSION['idUser'])) {
        $bdd = new PDO ('mysql:host='."database-etudiants.iut.univ-paris8.fr".';dbname='."dutinfopw201625", "dutinfopw201625", "razamaqe");
        $idUser = $bdd->prepare('select idUser from Posts where idPost = ?');
        $idUser->execute(array($_GET['idPost']));
        if ($idUser->fetch()['idUser'] == $_SESSION['idUser']) {
            $post = $bdd->prepare('delete from Posts where idPost = ?');
            $post->execute(array($_GET['idPost']));
        }
    }
?>