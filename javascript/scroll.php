<?php
    session_start();
    header('Content-type: application/json; charset=utf-8');
    define ("lala", "layn");
    include_once('../connexion.php');
    include_once('../vue_generique.php');
    include_once('../modele_generique.php');

    $bdd = new PDO ('mysql:host='."database-etudiants.iut.univ-paris8.fr".';dbname='."dutinfopw201625", "dutinfopw201625", "razamaqe");

    switch($_GET['action']) {
        case 'suivis' :
            if (!isset($_SESSION['idUser']))
                return 0;
            $sql = 'select Posts.idUser as idUser, Posts.idPost as idPost, login, pfp, lien, titre, descriptionPost, datePost, vote from Posts join Utilisateurs on Posts.idUser = Utilisateurs.idUser 
                left join VoterPost on Posts.idPost = VoterPost.idPost where (VoterPost.idUser = :idUser or VoterPost.idUser is null) and Posts.idUser in (';
            $abonnements = $bdd->prepare('select idUserAbonnement from Abonner where idUserAbonne = ?');
            $abonnements->execute(array($_SESSION['idUser']));
            if ($abonnements->rowcount() == 0)
                return 1;
            for ($i = 0; $i < $abonnements->rowcount() - 1; $i++) {
                $sql = $sql . $abonnements->fetch()['idUserAbonnement'] . ",";
            }
            $sql = $sql . $abonnements->fetch()['idUserAbonnement'] . ') order by datePost desc limit :index, 20';
            $posts = $bdd->prepare($sql);
            $posts->bindValue(':index', $_GET['nb_posts'], PDO::PARAM_INT);
            $posts->bindParam(':idUser', $_SESSION['idUser']);
            $posts->execute();
            
            $posts = $posts->fetchAll();
            break;
        case 'recent' :
            $posts = $bdd->prepare('select Posts.idUser as idUser, Posts.idPost as idPost, login, pfp, lien, titre, descriptionPost, datePost from Posts join Utilisateurs on Posts.idUser = Utilisateurs.idUser order by datePost desc limit :index, 20');
            $posts->bindValue(':index', $_GET['nb_posts'], PDO::PARAM_INT);
            $posts->execute();
            $posts = $posts->fetchAll();
            break;
    }

    if (isset($posts) && count($posts) > 0) {
        Connexion::initConnexion();
        $modele = new ModeleGenerique();
        $votes  = $modele->get_votes($posts);
        $nb_votes = $modele->get_nb_votes($posts);
        $tags = $modele->get_tags($posts);

        $vue = new VueGenerique();
        for ($i = 0; $i < count($posts); $i++) {
            $vue->affiche_post($posts[$i], $votes[$i], $nb_votes[$i], $tags[$i]);
        }
        $array = array (
            'nb' => $_GET['nb_posts'],
            'posts' => $vue->getAffichage()
        );
        echo json_encode($array);
    }
?>