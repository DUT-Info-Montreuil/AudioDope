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
                "idUser"=>$_GET['idUser'],
                "login" => $login->fetch()['login'],
                "nb_abonnes" => $nb_abonnes->fetch()['count'],
                "nb_abonnement" => $nb_abonnement->fetch()['count']
            );
            return $profil;
        }
        public function verif_abonnement(){ 
            $sql=self::$bdd->prepare('SELECT count(iduser)from Abonner where idUserAbonne=? and idUserAbonnement=?');
            $sql->execute(array($_SESSION['idUser'],$_GET['idUser']));
            if($_SESSION['idUser']==$_GET['idUser']){
                return 0;
            } 
            if($sql->rowcount()==0){
                return 1;
            }else {
            
            return 2;
            }
    }
        public function abonnement(){
            $sql2=self::$bdd->prepare('INSERT INTO Abonner values(?,?)');
            $sql2->execute(array($_SESSION['idUser'],$_GET['idUser']));
    }
    public function desabonnement(){
        $sql2=self::$bdd->prepare('DELETE FROM Abonner where idUserAbonne=? and idUserAbonnement=?');
        $sql2->execute(array($_SESSION['idUser'],$_GET['idUser']));
}

}

?>