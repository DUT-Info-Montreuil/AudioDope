<?php
session_start();
header('Content-type: application/json; charset=utf-8');
define("lala", "layn");
include_once('../connexion.php');
include_once('../vue_generique.php');
include_once('../modele_generique.php');

$bdd = new PDO('mysql:host=' . "database-etudiants.iut.univ-paris8.fr" . ';dbname=' . "dutinfopw201625", "dutinfopw201625", "razamaqe");

switch ($_GET['action']) {
    case 'recommandes':
        $tags = $bdd->prepare('SELECT * FROM Apprecier where idUser = ?');
        $tags->execute(array($_SESSION['idUser']));

        if ($tags->rowcount() == 0)
            $sql = 'select idUser, Posts.idPost as idPost, login, pfp, lien, titre, descriptionPost, datePost from Posts 
        natural join Utilisateurs left join AttribuerPost on Posts.idPost = AttribuerPost.idPost 
        where idUser not in (select idUserAbonnement from Abonner where idUserAbonne = :idUser) and idUser != :idUser
        order by datePost desc limit :index, 20';
        else
            $sql = 'select Distinct idUser, Posts.idPost as idPost, login, pfp, lien, titre, descriptionPost, datePost from Posts 
        natural join Utilisateurs left join AttribuerPost on Posts.idPost = AttribuerPost.idPost 
        where idTag in (SELECT idTag FROM Apprecier where idUser = :idUser) and idUser not in (select idUserAbonnement from Abonner where idUserAbonne = :idUser) and idUser != :idUser
        order by datePost desc limit :index, 20';

        $posts = $bdd->prepare($sql);
        $posts->bindValue(':index', $_GET['nb_posts'], PDO::PARAM_INT);
        $posts->bindParam(':idUser', $_SESSION['idUser']);
        $posts->execute();

        $posts = $posts->fetchAll();
        break;
    case 'decouverte':
        $sql = 'select Distinct idUser, Posts.idPost as idPost, login, pfp, lien, titre, descriptionPost, datePost from Posts 
        natural join Utilisateurs left join AttribuerPost on Posts.idPost = AttribuerPost.idPost 
        where idTag not in (SELECT idTag FROM Apprecier where idUser = :idUser) and idUser not in (select idUserAbonnement from Abonner where idUserAbonne = :idUser) and idUser != :idUser
        order by datePost desc limit :index, 20';

        $posts = $bdd->prepare($sql);
        $posts->bindValue(':index', $_GET['nb_posts'], PDO::PARAM_INT);
        $posts->bindParam(':idUser', $_SESSION['idUser']);
        $posts->execute();

        $posts = $posts->fetchAll();
        if (count($posts) < 20) {
            $nb = 20 - count($posts);
            
            $sql = 'select idUser, Posts.idPost as idPost, login, pfp, lien, titre, descriptionPost, datePost from Posts 
        natural join Utilisateurs left join AttribuerPost on Posts.idPost = AttribuerPost.idPost 
        where idTag is null and idUser not in (select idUserAbonnement from Abonner where idUserAbonne = :idUser) and idUser != :idUser
        order by datePost desc limit :index, :nb';

            $posts2 = $bdd->prepare($sql);
            $posts2->bindParam(':idUser', $_SESSION['idUser']);
            $posts2->bindValue(':nb', $nb, PDO::PARAM_INT);
            $posts2->bindValue(':index', $_GET['nb_posts'], PDO::PARAM_INT);
            $posts2->execute();
            $posts = array_merge($posts, $posts2->fetchAll());
        }
        break;
    case 'suivis':
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
    case 'recent':
        $posts = $bdd->prepare('select Posts.idUser as idUser, Posts.idPost as idPost, login, pfp, lien, titre, descriptionPost, datePost from Posts join Utilisateurs on Posts.idUser = Utilisateurs.idUser order by datePost desc limit :index, 20');
        $posts->bindValue(':index', $_GET['nb_posts'], PDO::PARAM_INT);
        $posts->execute();
        $posts = $posts->fetchAll();
        break;
    case 'voir_profil':
        $posts = $bdd->prepare('select Posts.idUser as idUser, Posts.idPost as idPost, login, pfp, lien, titre, descriptionPost, datePost from Posts join Utilisateurs on Posts.idUser = Utilisateurs.idUser where Posts.idUser = :idUser order by datePost desc limit :index, 20');
        $posts->bindValue(':index', $_GET['nb_posts'], PDO::PARAM_INT);
        $posts->bindParam(':idUser', $_GET['idUser']);
        $posts->execute();
        $posts = $posts->fetchAll();
        break;
    case 'recherche_post':
        switch ($_GET['filtre']) {
            case 'tout':
                $posts = $bdd->prepare('select idUser, idPost, login, pfp, lien, titre, descriptionPost, datePost from Posts natural join Utilisateurs where idPost in (select idPost from AttribuerPost natural join Tags where nomTag like :contenu) or titre like :contenu or descriptionPost like :contenu or login like :contenu order by datePost desc limit :index, 20');
                $posts->bindValue(':index', $_GET['nb_posts'], PDO::PARAM_INT);
                $posts->bindValue(':contenu', "%$_GET[contenu]%");
                $posts->execute();
                $posts = $posts->fetchAll();
                break;
            case 'tag':
                $posts = $bdd->prepare('select idUser, idPost, login, pfp, lien, titre, descriptionPost, datePost from Posts natural join Utilisateurs where idPost in (select idPost from AttribuerPost natural join Tags where nomTag like :contenu) order by datePost desc limit :index, 20');
                $posts->bindValue(':index', $_GET['nb_posts'], PDO::PARAM_INT);
                $posts->bindValue(':contenu', "%$_GET[contenu]%");
                $posts->execute();
                $posts = $posts->fetchAll();
                break;
            case 'titre':
                $posts = $bdd->prepare('select idUser, idPost, login, pfp, lien, titre, descriptionPost, datePost from Posts natural join Utilisateurs where titre like :contenu order by datePost desc limit :index, 20');
                $posts->bindValue(':index', $_GET['nb_posts'], PDO::PARAM_INT);
                $posts->bindValue(':contenu', "%$_GET[contenu]%");
                $posts->execute();
                $posts = $posts->fetchAll();
                break;
            case 'desc':
                $posts = $bdd->prepare('select idUser, idPost, login, pfp, lien, titre, descriptionPost, datePost from Posts natural join Utilisateurs where descriptionPost like :contenu order by datePost desc limit :index, 20');
                $posts->bindValue(':index', $_GET['nb_posts'], PDO::PARAM_INT);
                $posts->bindValue(':contenu', "%$_GET[contenu]%");
                $posts->execute();
                $posts = $posts->fetchAll();
                break;
            case 'user':
                $posts = $bdd->prepare('select idUser, idPost, login, pfp, lien, titre, descriptionPost, datePost from Posts natural join Utilisateurs where login like :contenu order by datePost desc limit :index, 20');
                $posts->bindValue(':index', $_GET['nb_posts'], PDO::PARAM_INT);
                $posts->bindValue(':contenu', "%$_GET[contenu]%");
                $posts->execute();
                $posts = $posts->fetchAll();
                break;
        }
        break;
}

if (isset($posts)) {
    if (count($posts) == 0) {
        $array = array();
    } else {
        Connexion::initConnexion();
        $modele = new ModeleGenerique();
        $votes  = $modele->get_votes($posts);
        $nb_votes = $modele->get_nb_votes($posts, 0);
        $tags = $modele->get_tags($posts);
        $aimer_tags = $modele->aimer_tags($tags);

        $vue = new VueGenerique();
        for ($i = 0; $i < count($posts); $i++) {
            $vue->affiche_post($posts[$i], $votes[$i], $nb_votes[$i], $tags[$i], $aimer_tags);
        }

        $array = array(
            'posts' => $vue->getAffichage()
        );
    }
    echo json_encode($array);
}
