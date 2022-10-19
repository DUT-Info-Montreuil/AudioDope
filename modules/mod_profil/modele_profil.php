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
        public function abonnement(){
            $sql=self::$bdd->prepare('select idUser from Utilisateurs where login=?');
            $sql->execute(array($_GET['login']));
            $iduserAbonnement=$sql->fetch()['idUser'];
            $sql2=self::$bdd->prepare('select idUser from Utilisateurs where login=?');
            $sql2->execute(array($_SESSION['login']));
            $iduserAbonne=$sql2->fetch()['idUser'];
            $sql3=self::$bdd->prepare('INSERT INTO Abonner values(?,?)');
            var_dump($iduserAbonne);
            var_dump($iduserAbonnement);
            $sql3->execute(array($iduserAbonne,$iduserAbonnement));
    }
}
?>