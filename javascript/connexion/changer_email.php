<?php
// GNU GPL Copyleft 2022 
    session_start();
    header('Content-type: application/json; charset=utf-8');

    $bdd = new PDO ('mysql:host='."database-etudiants.iut.univ-paris8.fr".';dbname='."dutinfopw201625", "dutinfopw201625", "razamaqe");

    $array = null;

    if (isset($_SESSION['token']) && $_POST['token'] == $_SESSION['token'] && time() - $_SESSION['token_date'] < 900) {
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $array = array(
                'erreur' => 'L\'adressse e-mail est invalide'
            );
        } else {
            $email = $bdd->prepare('select * from Utilisateurs where email = ?');
            $email->execute(array($_POST['email']));
            if ($email->rowCount() > 0) {
                $array = array(
                    'erreur' => 'L\'adresse e-mail est déjà utilisée'
                );
            } else {
                $email = $bdd->prepare('update Utilisateurs set email = :email where idUser = :idUser');
                $email->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
                $email->bindParam(':idUser', $_SESSION['idUser']);
                $email->execute();
            }
        }
    } else {
        if (isset($_SESSION['token'])) {
            unset($_SESSION['token']);
            unset($_SESSION['token_date']);
        }
        $array = array(
            'erreur' => 'Session expirée'
        );
    }
    echo json_encode($array);
?>