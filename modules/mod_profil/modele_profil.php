<?php
// GNU GPL Copyleft 2022 
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

    public function get_posts()
    {
        $posts = self::$bdd->prepare('select Posts.idUser as idUser, Posts.idPost as idPost, login, pfp, lien, titre, descriptionPost, datePost from Posts join Utilisateurs on Posts.idUser = Utilisateurs.idUser where Posts.idUser = ? order by datePost desc limit 20');
        $posts->execute(array($_GET['idUser']));
        return $posts->fetchAll();
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
}
