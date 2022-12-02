<?php
// GNU GPL Copyleft 2022 
    session_start();
    header('Content-type: application/json; charset=utf-8');
    if (!isset($_SESSION['idUser'])) {
        $array = array(
            "connecte" => false
        );
    } else {
        $bdd = new PDO('mysql:host=' . "database-etudiants.iut.univ-paris8.fr" . ';dbname=' . "dutinfopw201625", "dutinfopw201625", "razamaqe");
        $vote = $bdd->prepare('INSERT INTO Apprecier VALUES (?, ?)');
        $vote->execute(array($_SESSION['idUser'], $_GET['idTag']));
        $array = array(
            "connecte" => true,
        );
    }
    echo json_encode($array);
?>