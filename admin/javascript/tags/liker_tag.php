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
        $vote = $bdd->prepare('INSERT INTO Apprecier VALUES (?, ?)');
        $vote->execute(array($_SESSION['idUser'], $_GET['idTag']));
        $array = array(
            "connecte" => true,
        );
    }
    echo json_encode($array);
?>