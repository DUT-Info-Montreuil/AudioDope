<?php
    session_start();
    header('Content-type: application/json; charset=utf-8');
    include 'connexion.php';
    if (!isset($_SESSION['idUser'])) {
        $array = array(
            "connecte" => false
        );
    } else {
        $co = new Connexion();
        $vote = $bdd->prepare('select vote from VoterPost where idUser = ? and idPost = ?');
        $vote->execute(array($_SESSION['idUser'], $_GET['idPost']));
    $array = array(
        "connecte" => true,
        "vote" => $v,
        "nb_vote" => $nb_vote
    );
}
echo json_encode($array);
?>