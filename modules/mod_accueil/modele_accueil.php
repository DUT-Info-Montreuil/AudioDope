<?php
/*AudioDope - Version 1.0 - 2022
GNU GPL CopyLeft 2022-2032
Hugo COHEN - Ayoub BOUAZIZ - Steven YANG*/
if (constant("lala") != "layn")
    die("wrong constant");

include_once('modele_generique.php');

class ModeleAccueil extends ModeleGenerique
{

    //postes les plus récents de la plateforme
    public function get_recent()
    {
        $posts = self::$bdd->prepare('select idUser, idPost, login, pfp, lien, titre, descriptionPost, datePost from Posts natural join Utilisateurs order by datePost desc limit 20');
        $posts->execute();
        return $posts->fetchAll();
    }

    //postes des abonnements de l'utilisateur
    public function get_suivi()
    {
        if (!isset($_SESSION['idUser']))
            return 0;

        $sql = 'select Posts.idUser as idUser, Posts.idPost as idPost, login, pfp, lien, titre, descriptionPost, datePost, vote from Posts join Utilisateurs on Posts.idUser = Utilisateurs.idUser 
            left join VoterPost on Posts.idPost = VoterPost.idPost where (VoterPost.idUser = :idUser or VoterPost.idUser is null) 
            and Posts.idUser in (select idUserAbonnement from Abonner where idUserAbonne = :idUser) order by datePost desc limit 20';
        $posts = self::$bdd->prepare($sql);
        $posts->bindParam(':idUser', $_SESSION['idUser']);
        $posts->execute();
        if ($posts->rowcount() == 0)
            return 1;
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

    //posts selon les tags qu'apprécie l'utilisateur qui ne sont pas de ceux que l'utilisatueur suit
    //affiche des postes au hasard si l'utilisateur n'apprécie aucun tag
    public function get_recommandes()
    {   
        if (!isset($_SESSION['idUser']))
            return 0;

        $tags = self::$bdd->prepare('SELECT * FROM Apprecier where idUser = ?');
        $tags->execute(array($_SESSION['idUser']));
        
        if($tags->rowcount() == 0)
            $sql = 'select idUser, Posts.idPost as idPost, login, pfp, lien, titre, descriptionPost, datePost from Posts 
        natural join Utilisateurs left join AttribuerPost on Posts.idPost = AttribuerPost.idPost 
        where idUser not in (select idUserAbonnement from Abonner where idUserAbonne = :idUser) and idUser != :idUser
        order by datePost desc limit 20';
        else
            $sql = 'select Distinct idUser, Posts.idPost as idPost, login, pfp, lien, titre, descriptionPost, datePost from Posts 
        natural join Utilisateurs left join AttribuerPost on Posts.idPost = AttribuerPost.idPost 
        where idTag in (SELECT idTag FROM Apprecier where idUser = :idUser) and idUser not in (select idUserAbonnement from Abonner where idUserAbonne = :idUser) and idUser != :idUser
        order by datePost desc limit 20';

        $posts = self::$bdd->prepare($sql);
        $posts->bindParam(':idUser', $_SESSION['idUser']);
        $posts->execute();
        return $posts->fetchAll();
    }

    //posts selon les tags qu'apprécie l'utilisateur qui ne sont pas de ceux que l'utilisatueur suit
    public function get_decouverte()
    {   
        if (!isset($_SESSION['idUser']))
            return 0;

        $sql = 'select Distinct idUser, Posts.idPost as idPost, login, pfp, lien, titre, descriptionPost, datePost from Posts 
        natural join Utilisateurs left join AttribuerPost on Posts.idPost = AttribuerPost.idPost 
        where idTag not in (SELECT idTag FROM Apprecier where idUser = :idUser) and idUser not in (select idUserAbonnement from Abonner where idUserAbonne = :idUser) and idUser != :idUser
        order by datePost desc limit 20';

        $posts = self::$bdd->prepare($sql);
        $posts->bindParam(':idUser', $_SESSION['idUser']);
        $posts->execute();

        $posts = $posts->fetchAll();
        if (count($posts) < 20) {
            $nb = 20 - count($posts);
            
            $sql = 'select idUser, Posts.idPost as idPost, login, pfp, lien, titre, descriptionPost, datePost from Posts 
        natural join Utilisateurs left join AttribuerPost on Posts.idPost = AttribuerPost.idPost 
        where idTag is null and idUser not in (select idUserAbonnement from Abonner where idUserAbonne = :idUser) and idUser != :idUser
        order by datePost desc limit :nb';

            $posts2 = self::$bdd->prepare($sql);
            $posts2->bindParam(':idUser', $_SESSION['idUser']);
            $posts2->bindValue(':nb', $nb, PDO::PARAM_INT);
            $posts2->execute();
            $posts = array_merge($posts, $posts2->fetchAll());
        }
        return $posts;
    }
}
