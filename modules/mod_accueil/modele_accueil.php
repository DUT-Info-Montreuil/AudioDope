<?php

    if (constant("lala") != "layn")
        die("wrong constant");

    include_once('connexion.php');

    class ModeleAccueil extends Connexion {
        
        public function get_recent() {
            $posts = self::$bdd->prepare('select Posts.idUser as idUser, login, lien, titre, descriptionPost, datePost from Posts join Utilisateurs on Posts.idUser = Utilisateurs.idUser order by datePost desc limit 20');
            $posts->execute();
            return $posts->fetchAll();
        }

        public function get_suivi() {
            if (!isset($_SESSION['idUser']))
                return 0;
            $sql = 'select Posts.idUser as idUser, login, lien, titre, descriptionPost, datePost from Posts join Utilisateurs on Posts.idUser = Utilisateurs.idUser where Posts.idUser in (';
            $nb_abo = self::$bdd->prepare('select count(*) as count from Abonner where idUserAbonne = ?');
            $nb_abo->execute(array($_SESSION['idUser']));
            $abonnements = self::$bdd->prepare('select idUserAbonnement from Abonner where idUserAbonne = ?');
            $abonnements->execute(array($_SESSION['idUser']));
            for ($i = 0; $i < $nb_abo->fetch()['count'] - 1; $i++) {
                $sql = $sql.$abonnements->fetch()['idUserAbonnement'].",";
            }
            $sql = $sql.$abonnements->fetch()['idUserAbonnement'].') order by datePost desc limit 20';
            $posts = self::$bdd->prepare($sql);
            $posts->execute();
            return $posts->fetchAll();
        }
    }
?>