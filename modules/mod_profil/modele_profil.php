<?php

    if (constant("lala") != "layn")
        die("wrong constant");

    include_once('connexion.php');

    class ModeleProfil extends Connexion {

        public function getProfil() {
            $nb_abonnes = self::$bdd->prepare('select count(*) as count from Abonner where idUserAbonne  = ?');
            $nb_abonnes->execute(array($_GET['login']));
            $nb_abonnement = self::$bdd->prepare('select count(*) as count from Abonner where idUserAbonnement = ?');
            $nb_abonnement->execute(array($_GET['login']));
            $profil = array (
                "nb_abonnes" => $nb_abonnes->fetch()['count'],
                "nb_abonnement" => $nb_abonnement->fetch()['count']
            );
            return $profil;
        }

    }
?>