<?php
    header('Content-type: application/json; charset=utf-8');
    $bdd = new PDO ('mysql:host='."database-etudiants.iut.univ-paris8.fr".';dbname='."dutinfopw201625", "dutinfopw201625", "razamaqe");
    $vote = $bdd->prepare('select vote from VoterPost where idUser = ? and idPost = ?');
    $vote->execute(array($_GET['idUser'], $_GET['idPost']));
    if ($vote->rowcount() == 0) {
        $vote = self::$bdd->prepare('insert into VoterPost values (?,?,?)');
        $vote->execute(array($_GET['idUser'], $_GET['vote'], $_GET['idPost']));
        $v = $_GET['vote'];
    } else if ($vote->fetch()['vote'] == $_GET['vote']) {
        $vote = self::$bdd->prepare('delete from VoterPost where idUser = ? and idPost = ?');
        $vote->execute(array($_GET['idUser'], $_GET['idPost']));
        $v = 0;
    } else {
        $vote = self::$bdd->prepare('update VoterPost set vote = ? where idUser = ? and idPost = ?');
        $vote->execute(array($_GET['vote'], $_GET['idUser'], $_GET['idPost']));
        $v = $_GET['vote'];
    }
    $nb_vote = $bdd->prepare('select count(*) as count from VoterPost where idPost = ?');
    $nb_vote->execute(array($_GET['idPost']));

    $array = array(
        "vote"=>$v,
        "nb_vote"=>$nb_vote->fetch()['count']
    );
    echo json_encode($array);
?>