<?php

if (constant("lala") != "layn")
    die("wrong constant");

include_once('modele_generique.php');

class ModeleProfil extends ModeleGenerique
{

    public function getProfil()
    {
        $login = self::$bdd->prepare('select login, pfp from Utilisateurs where idUser = ?');
        $login->execute(array($_GET['idUser']));
        $login = $login->fetch();
        $nb_abonnes = self::$bdd->prepare('select count(*) as count from Abonner where idUserAbonnement = ?');
        $nb_abonnes->execute(array($_GET['idUser']));
        $nb_abonnement = self::$bdd->prepare('select count(*) as count from Abonner where idUserAbonne = ?');
        $nb_abonnement->execute(array($_GET['idUser']));
        $profil = array(
            "idUser" => $_GET['idUser'],
            "login" => $login['login'],
            "pfp" => $login['pfp'],
            "nb_abonnes" => $nb_abonnes->fetch()['count'],
            "nb_abonnement" => $nb_abonnement->fetch()['count']
        );
        return $profil;
    }

    public function getPosts()
    {
        $posts = self::$bdd->prepare('select Posts.idUser as idUser, Posts.idPost as idPost, login, pfp, lien, titre, descriptionPost, datePost from Posts join Utilisateurs on Posts.idUser = Utilisateurs.idUser where Posts.idUser = ? order by datePost desc limit 20');
        $posts->execute(array($_GET['idUser']));
        $posts = $posts->fetchAll();
        $tab = $this->get_posts_complet($posts);
        return $tab;
    }

    public function getAbonne()
    {
        $listeAbonne = self::$bdd->prepare('select idUser, login from Abonner inner join Utilisateurs on (Abonner.idUserAbonne= Utilisateurs.idUser) where idUserAbonnement = ?');
        $listeAbonne->execute(array($_SESSION['idUser']));
        $tab = $listeAbonne->fetchAll();
        $verif_abo = array();
        for ($i = 0; $i < count($tab); $i++) {
            $verif_abo[$i] = $this->verif_abonnement($tab[$i]['idUser']);
        }
        $array = array(
            "info" => $tab,
            "abo" => $verif_abo
        );
        return $array;
    }

    public function getAbonnement()
    {
        $listeAbonnement = self::$bdd->prepare('select idUser, login from Abonner inner join Utilisateurs on (Abonner.idUserAbonnement= Utilisateurs.idUser) where idUserAbonne = ?');
        $listeAbonnement->execute(array($_SESSION['idUser']));
        $tab = $listeAbonnement->fetchAll();
        $verif_abo = array();
        for ($i = 0; $i < count($tab); $i++) {
            $verif_abo[$i] = $this->verif_abonnement($tab[$i]['idUser']);
        }
        $array = array(
            "info" => $tab,
            "abo" => $verif_abo
        );
        return $array;
    }

    public function verif_abonnement($idUser)
    {
        if (!isset($_SESSION['idUser']) || $_SESSION['idUser'] == $idUser) {
            return 0;
        }
        $sql = self::$bdd->prepare('SELECT * from Abonner where Abonner.idUserAbonne=? and Abonner.idUserAbonnement=?');
        $sql->execute(array($_SESSION['idUser'], $idUser));
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
