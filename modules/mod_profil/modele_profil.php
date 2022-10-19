<?php

    if (constant("lala") != "layn")
        die("wrong constant");

    include_once('connexion.php');

    class ModeleProfil extends Connexion {

        public function getProfil() {
            $login = self::$bdd->prepare('select login from Utilisateurs where idUser = ?');
            $login->execute(array($_GET['idUser']));
            $nb_abonnes = self::$bdd->prepare('select count(*) as count from Abonner where idUserAbonnement = ?');
            $nb_abonnes->execute(array($_GET['idUser']));
            $nb_abonnement = self::$bdd->prepare('select count(*) as count from Abonner where idUserAbonne = ?');
            $nb_abonnement->execute(array($_GET['idUser']));
            $profil = array (
                "login" => $login->fetch()['login'],
                "nb_abonnes" => $nb_abonnes->fetch()['count'],
                "nb_abonnement" => $nb_abonnement->fetch()['count']
            );
            return $profil;
        }

    }
?>