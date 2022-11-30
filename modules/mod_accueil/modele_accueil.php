<?php

if (constant("lala") != "layn")
    die("wrong constant");

include_once('modele_generique.php');

class ModeleAccueil extends ModeleGenerique
{

    public function get_recent()
    {
        $posts = self::$bdd->prepare('select Posts.idUser as idUser, Posts.idPost as idPost, login, pfp, lien, titre, descriptionPost, datePost from Posts join Utilisateurs on Posts.idUser = Utilisateurs.idUser order by datePost desc limit 20');
        $posts->execute();
        return $posts->fetchAll();
    }

    public function get_suivi()
    {
        if (!isset($_SESSION['idUser']))
            return 0;
        $sql = 'select Posts.idUser as idUser, Posts.idPost as idPost, login, pfp, lien, titre, descriptionPost, datePost, vote from Posts join Utilisateurs on Posts.idUser = Utilisateurs.idUser 
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
        
        return $posts->fetchAll();
    }

    //POST DES SEPTS DERNIERS JOURS LE PLUS D'UPVOTE (Peut afficher ceux à zero du a la conception de la BD, dans tout les cas cela veux dire qu'il y'a eu interaction avec et ils seront
    //toujours en dessous de ceux avec des votes)
    public function get_tendance() {
        if (!isset($_SESSION['idUser']))
            return 0;
            
        $sql = 'SELECT DISTINCT Posts.idUser as idUser, Posts.idPost as idPost, login, pfp, lien, titre, descriptionPost, datePost, vote, VoteOrdre.nbVote  
            FROM Posts 
            JOIN Utilisateurs ON Posts.idUser = Utilisateurs.idUser
            LEFT JOIN VoterPost on Posts.idPost = VoterPost.idPost 
            INNER JOIN (SELECT sum(vote) as nbVote, idPost
                    FROM VoterPost 
                    GROUP BY VoterPost.idPost 
                    ORDER BY sum(vote) DESC
            ) AS VoteOrdre ON VoteOrdre.idPost = Posts.idPost
            WHERE (DATEDIFF (now(), Posts.datePost) <= 7)
            ORDER BY nbVote DESC';
        
        $posts = self::$bdd->prepare($sql);
        $posts->execute(array($_SESSION['idUser']));
        if ($posts->rowcount() == 0)
            return 1;
        return $posts->fetchAll();
    }

}
