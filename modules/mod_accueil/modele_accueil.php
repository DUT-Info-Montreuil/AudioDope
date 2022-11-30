<?php

if (constant("lala") != "layn")
    die("wrong constant");

include_once('modele_generique.php');

class ModeleAccueil extends ModeleGenerique
{

    public function get_recent($index)
    {
        $posts = self::$bdd->prepare('select Posts.idUser as idUser, Posts.idPost as idPost, login, pfp, lien, titre, descriptionPost, datePost from Posts join Utilisateurs on Posts.idUser = Utilisateurs.idUser order by datePost desc limit :index, 20');
        $posts->bindValue(':index', $index, PDO::PARAM_INT);
        $posts->execute();
        return $posts->fetchAll();
    }

    public function get_suivi($index)
    {
        if (!isset($_SESSION['idUser']))
            return 0;
        $sql = 'select Posts.idUser as idUser, Posts.idPost as idPost, login, pfp, lien, titre, descriptionPost, datePost, vote from Posts join Utilisateurs on Posts.idUser = Utilisateurs.idUser 
            left join VoterPost on Posts.idPost = VoterPost.idPost where (VoterPost.idUser = :idUser or VoterPost.idUser is null) and Posts.idUser in (';
        $abonnements = self::$bdd->prepare('select idUserAbonnement from Abonner where idUserAbonne = ?');
        $abonnements->execute(array($_SESSION['idUser']));
        if ($abonnements->rowcount() == 0)
            return 1;
        for ($i = 0; $i < $abonnements->rowcount() - 1; $i++) {
            $sql = $sql . $abonnements->fetch()['idUserAbonnement'] . ",";
        }
        $sql = $sql . $abonnements->fetch()['idUserAbonnement'] . ') order by datePost desc limit :index, 20';
        $posts = self::$bdd->prepare($sql);
        $posts->bindValue(':index', $index, PDO::PARAM_INT);
        $posts->bindParam(':idUser', $_SESSION['idUser']);
        $posts->execute();
        
        return $posts->fetchAll();
    }
}
