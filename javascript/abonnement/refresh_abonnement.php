<?php
    session_start();
    header('Content-type: application/json; charset=utf-8');
    
    if (isset($_SESSION['idUser'])) {
        $bdd = new PDO ('mysql:host='."database-etudiants.iut.univ-paris8.fr".';dbname='."dutinfopw201625", "dutinfopw201625", "razamaqe");
        $sql = $bdd->prepare('SELECT count(*) as count FROM Abonner where Abonner.idUserAbonne=?');
        $sql->execute(array($_SESSION['idUser']));
        $data = array (
            "data" => $sql->fetch()['count']
        );

        echo json_encode($data);
    }
?>