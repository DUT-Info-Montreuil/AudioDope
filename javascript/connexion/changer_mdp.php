<?php
// GNU GPL Copyleft 2022 
    session_start();
    header('Content-type: application/json; charset=utf-8');

    $bdd = new PDO ('mysql:host='."database-etudiants.iut.univ-paris8.fr".';dbname='."dutinfopw201625", "dutinfopw201625", "razamaqe");

    $array = null;

    if (isset($_SESSION['token']) && $_POST['token'] == $_SESSION['token'] && time() - $_SESSION['token_date'] < 900) {
        $password = $bdd->prepare('select password from Utilisateurs where idUser = ?');
        $password->execute(array($_SESSION['idUser']));
        if (!password_verify($_POST['mdp'], $password->fetch()['password'])) {
            $array = array(
                'erreur' => 'Le mot de pass actuel incorrecte'
            );
        } else if (!(preg_match('/[a-z]/', $_POST['nouv_mdp']) && preg_match('/[A-Z]/', $_POST['nouv_mdp']) && preg_match('/\d/', $_POST['nouv_mdp']) && strlen($_POST['nouv_mdp']) >= 8)) {
            $array = array(
                'erreur' => '8 caractères minimum avec au moins une lettre minuscule, une lettre majuscule et un chiffre'
            );
        } else if ($_POST['nouv_mdp'] != $_POST['conf_mdp']) {
            $array = array(
                'erreur' => 'Les mots de passe ne correspondent pas'
            );
        } else {
            $mdp = password_hash($_POST['nouv_mdp'], PASSWORD_DEFAULT);
            $sql = $bdd->prepare('update Utilisateurs set password = :mdp where idUser = :idUser');
            $sql->bindValue(':mdp', $mdp, PDO::PARAM_STR);
            $sql->bindParam(':idUser', $_SESSION['idUser']);
            $sql->execute();
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