<?php
/*AudioDope - Version 1.0 - 2022
GNU GPL CopyLeft 2022-2032
Hugo COHEN - Ayoub BOUAZIZ - Steven YANG*/ 
    session_start();
    header('Content-type: application/json; charset=utf-8');
    if (!isset($_SESSION['idUser'])) {
        $array = array(
            "connecte" => false
        );
    } else {
        $bdd = new PDO('mysql:host=' . "database-etudiants.iut.univ-paris8.fr" . ';dbname=' . "dutinfopw201625", "dutinfopw201625", "razamaqe");
        $vote = $bdd->prepare('select vote from VoterPost where idUser = ? and idPost = ?');
        $vote->execute(array($_SESSION['idUser'], $_GET['idPost']));
        if ($vote->rowcount() == 0) {
            $vote = $bdd->prepare('insert into VoterPost values (?,?,?)');
            $vote->execute(array($_SESSION['idUser'], $_GET['vote'], $_GET['idPost']));
            $v = $_GET['vote'];
        } else if ($vote->fetch()['vote'] == $_GET['vote']) {
            $vote = $bdd->prepare('delete from VoterPost where idUser = ? and idPost = ?');
            $vote->execute(array($_SESSION['idUser'], $_GET['idPost']));
            $v = 0;
        } else {
            $vote = $bdd->prepare('update VoterPost set vote = ? where idUser = ? and idPost = ?');
            $vote->execute(array($_GET['vote'], $_SESSION['idUser'], $_GET['idPost']));
            $v = $_GET['vote'];
        }
        $nb_vote = $bdd->prepare('select sum(vote) as somme from VoterPost where idPost = ?');
        $nb_vote->execute(array($_GET['idPost']));
        $nb_vote = $nb_vote->fetch()['somme'];
        if ($nb_vote == NULL)
            $nb_vote = 0;
        $array = array(
            "connecte" => true,
            "vote" => $v,
            "nb_vote" => $nb_vote
        );
    }
    echo json_encode($array);
?>