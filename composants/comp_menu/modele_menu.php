<?php
    /*AudioDope - Version 1.0 - 2022
GNU GPL CopyLeft 2022-2032
Hugo COHEN - Ayoub BOUAZIZ - Steven YANG*/
    if (constant("lala") != "layn")
        die("wrong constant");

    include_once('connexion.php');
    
    class ModeleMenu extends Connexion {

        public function verif_admin() {
            if (isset($_SESSION['login'])) {
                $statement = self::$bdd->prepare('SELECT idRoles FROM `Utilisateurs` WHERE idUser = ?');
                $statement->execute(array($_SESSION['idUser']));
                $idRole = $statement->fetch();
                if (count($idRole) == 0)
                    return -1;
                if ($idRole['idRoles'] == 2)
                    return 1;
                else 
                    return 0;
                }
            return -2;
        }
    }
?>