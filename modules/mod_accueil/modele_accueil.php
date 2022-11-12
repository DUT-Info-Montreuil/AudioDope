<?php

if (constant("lala") != "layn")
    die("wrong constant");

include_once('connexion.php');

class ModeleAccueil extends Connexion
{

    public function get_recent()
    {
        if (isset($_SESSION['idUser'])) {
            $posts = self::$bdd->prepare('select Posts.idUser as idUser, Posts.idPost as idPost, login, lien, titre, descriptionPost, datePost, vote from Posts join Utilisateurs on Posts.idUser = Utilisateurs.idUser 
            left join VoterPost on Posts.idPost = VoterPost.idPost where (VoterPost.idUser = ? or VoterPost.idUser is null) order by datePost desc limit 20');
            $posts->execute(array($_SESSION['idUser']));
        } else {
            $posts = self::$bdd->prepare('select Posts.idUser as idUser, Posts.idPost as idPost, login, lien, titre, descriptionPost, datePost from Posts join Utilisateurs on Posts.idUser = Utilisateurs.idUser order by datePost desc limit 20');
            $posts->execute();
        }
        return $posts->fetchAll();
    }

    public function get_suivi()
    {
        if (!isset($_SESSION['idUser']))
            return 0;
        $sql = 'select Posts.idUser as idUser, Posts.idPost as idPost, login, lien, titre, descriptionPost, datePost, vote from Posts join Utilisateurs on Posts.idUser = Utilisateurs.idUser 
            left join VoterPost on Posts.idPost = VoterPost.idPost where (VoterPost.idUser = ? or VoterPost.idUser is null) and Posts.idUser in (';
        $abonnements = self::$bdd->prepare('select idUserAbonnement from Abonner where idUserAbonne = ?');
        $abonnements->execute(array($_SESSION['idUser']));
        for ($i = 0; $i < $abonnements->rowcount() - 1; $i++) {
            $sql = $sql . $abonnements->fetch()['idUserAbonnement'] . ",";
        }
        $sql = $sql . $abonnements->fetch()['idUserAbonnement'] . ') order by datePost desc limit 20';
        $posts = self::$bdd->prepare($sql);
        $posts->execute(array($_SESSION['idUser']));
        return $posts->fetchAll();
    }
}
