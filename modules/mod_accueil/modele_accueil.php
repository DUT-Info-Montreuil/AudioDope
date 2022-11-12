<?php

if (constant("lala") != "layn")
    die("wrong constant");

include_once('modele_generique.php');

class ModeleAccueil extends ModeleGenerique
{

    public function get_recent()
    {
        $posts = self::$bdd->prepare('select Posts.idUser as idUser, Posts.idPost as idPost, login, lien, titre, descriptionPost, datePost from Posts join Utilisateurs on Posts.idUser = Utilisateurs.idUser order by datePost desc limit 20');
        $posts->execute();
        $posts = $posts->fetchAll();
        $tab = $this->get_posts_complet($posts);
        return $tab;
    }

    public function get_suivi()
    {
        if (!isset($_SESSION['idUser']))
            return 0;
        $sql = 'select Posts.idUser as idUser, Posts.idPost as idPost, login, lien, titre, descriptionPost, datePost, vote from Posts join Utilisateurs on Posts.idUser = Utilisateurs.idUser 
            left join VoterPost on Posts.idPost = VoterPost.idPost where (VoterPost.idUser = ? or VoterPost.idUser is null) and Posts.idUser in (';
        $abonnements = self::$bdd->prepare('select idUserAbonnement from Abonner where idUserAbonne = ?');
        $abonnements->execute(array($_SESSION['idUser']));
        if ($abonnements->rowcount() == 0)
            return 1;
        for ($i = 0; $i < $abonnements->rowcount() - 1; $i++) {
            $sql = $sql . $abonnements->fetch()['idUserAbonnement'] . ",";
        }
        $sql = $sql . $abonnements->fetch()['idUserAbonnement'] . ') order by datePost desc limit 20';
        $posts = self::$bdd->prepare($sql);
        $posts->execute(array($_SESSION['idUser']));
        $posts = $posts->fetchAll();
        $tab = $this->get_posts_complet($posts);
        return $tab;
    }
}
