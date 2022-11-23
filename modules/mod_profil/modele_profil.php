<?php

if (constant("lala") != "layn")
    die("wrong constant");

include_once('connexion.php');

class ModeleProfil extends Connexion
{

    public function getProfil()
    {
        $login = self::$bdd->prepare('select login from Utilisateurs where idUser = ?');
        $login->execute(array($_GET['idUser']));
        $nb_abonnes = self::$bdd->prepare('select count(*) as count from Abonner where idUserAbonnement = ?');
        $nb_abonnes->execute(array($_GET['idUser']));
        $nb_abonnement = self::$bdd->prepare('select count(*) as count from Abonner where idUserAbonne = ?');
        $nb_abonnement->execute(array($_GET['idUser']));
        $profil = array(
            "idUser" => $_GET['idUser'],
            "login" => $login->fetch()['login'],
            "nb_abonnes" => $nb_abonnes->fetch()['count'],
            "nb_abonnement" => $nb_abonnement->fetch()['count']
        );
        return $profil;
    }

    public function getPosts()
    {
        $posts = self::$bdd->prepare('select Posts.idUser as idUser, idPost, login, lien, titre, descriptionPost, datePost from Posts join Utilisateurs on Posts.idUser = Utilisateurs.idUser where Posts.idUser = ? order by datePost desc limit 20');
        $posts->execute(array($_GET['idUser']));
        return $posts->fetchAll();
    }
    public function get_nombre_post_collection($collections){
        foreach($collections as $col){
        $nb_post= self::$bdd->prepare('SELECT * from Collections inner join Appartenir using(idCollection) where idCollection=? ');
        $nb_post->execute(array($col['idCollection']));
       return $nb_post->rowcount();
    }
    }
    public function getCollection()
    {
        $collections = self::$bdd->prepare('select Collections.idUser as idUser, idCollection, login, titreCollection, descriptionCollection, prive from Collections join Utilisateurs on Collections.idUser = Utilisateurs.idUser where Collections.idUser = ?');
        $collections->execute(array($_GET['idUser']));
        return $collections->fetchAll();
    }

    public function getAbonne()
    {
        $listeAbonne = self::$bdd->prepare('select login from Abonner inner join Utilisateurs on (Abonner.idUserAbonne= Utilisateurs.idUser) where idUserAbonnement = ?');
        $listeAbonne->execute(array($_SESSION['idUser']));
        return $listeAbonne->fetchAll();
    }

    public function getAbonnement()
    {
        $listeAbonnement = self::$bdd->prepare('select login from Abonner inner join Utilisateurs on (Abonner.idUserAbonnement= Utilisateurs.idUser) where idUserAbonne = ?');
        $listeAbonnement->execute(array($_SESSION['idUser']));
        return $listeAbonnement->fetchAll();
    }

    public function verif_abonnement()
    {
        if (!isset($_SESSION['idUser']) || $_SESSION['idUser'] == $_GET['idUser']) {
            return 0;
        }
        $sql = self::$bdd->prepare('SELECT * from Abonner where Abonner.idUserAbonne=? and Abonner.idUserAbonnement=?');
        $sql->execute(array($_SESSION['idUser'], $_GET['idUser']));
        if ($sql->rowcount() == 0) {
            return 1;
        } else if ($sql->rowcount() == 1) {
            return 2;
        } else {
            return 3;
        }
    }
    public function abonnement()
    {
        $sql2 = self::$bdd->prepare('INSERT INTO Abonner values(?,?)');
        $sql2->execute(array($_SESSION['idUser'], $_GET['idUser']));
    }

    public function desabonnement()
    {
        $sql3 = self::$bdd->prepare('DELETE FROM Abonner where Abonner.idUserAbonne=? and Abonner.idUserAbonnement=?');
        $sql3->execute(array($_SESSION['idUser'], $_GET['idUser']));
    }
}
