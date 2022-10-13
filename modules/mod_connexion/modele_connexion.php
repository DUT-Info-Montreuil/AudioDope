<?php
    include_once('connexion.php');

    class ModeleConnexion extends Connexion {

        public function inscription() {
            if (strcmp($_POST['token'], $_SESSION['token']) != 0)
                return 0;
            $verif_login = self::$bdd->prepare('select * from utilisateurs where login = ?');
            $verif_login->execute(array($_POST['login']));
            if ($verif_login->rowCount() > 0) {
                return 1;
            } else if (!$this->mdp_correcte()) {
                return 2;
            } else if (strcmp($_POST['mdp'],$_POST['conf_mdp']) != 0) {
                return 3;
            } else {
                $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
                $sql = 'INSERT INTO utilisateurs VALUES(NULL, ?, ?)';
                $statement = self::$bdd->prepare($sql);
                $statement->execute(array($_POST['login'], $mdp));
            }
            unset($_SESSION['token']);
        }

        private function mdp_correcte() {
            $containsLowerCaseLetter  = preg_match('/[a-z]/', $_POST['mdp']);
            $containsUpperCaseLetter  = preg_match('/[A-Z]/', $_POST['mdp']);
            $containsDigit   = preg_match('/\d/', $_POST['mdp']);
            $containsSpecial = preg_match('/[^a-zA-Z\d]/', $_POST['mdp']);
            $correctSize = strlen($_POST['mdp']) >= 8;
            return $containsLowerCaseLetter && $containsUpperCaseLetter && $containsDigit && $containsSpecial && $correctSize;
        }

        public function connexion() {
            if (strcmp($_POST['token'], $_SESSION['token']) != 0)
                return 0;
            $sql = 'select * from utilisateurs where login = ?';
            $verif_login = self::$bdd->prepare($sql);
            $verif_login->execute(array($_POST['login']));
            if ($verif_login->rowCount() == 0 || !password_verify($_POST['mdp'], $verif_login->fetch()['motDePasse'])) {
                return 1;
            } else if (isset($_SESSION['login'])) {
                return 2;
            }
            $_SESSION['login'] = $_POST['login'];
            unset($_SESSION['token']);
        }

        public function creation_token() {
            $bytes = random_bytes(20);
            $_SESSION['token'] = bin2hex($bytes);
        }
    }
?>