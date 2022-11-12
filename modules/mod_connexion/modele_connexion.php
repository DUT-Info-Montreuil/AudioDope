<?php

    if (constant("lala") != "layn")
        die("wrong constant");

    include_once('connexion.php');

    class ModeleConnexion extends Connexion {

        public function deconnexion() {
            unset($_SESSION['login']);
            unset($_SESSION['idUser']);
        }
        public function inscription() {
            if (!$this->verif_token())
                return 1;
            $verif_login = self::$bdd->prepare('select * from Utilisateurs where login = ?');
            $verif_login->execute(array($_POST['login']));
            if ($verif_login->rowCount() > 0) {
                return 2;
            } else if (!$this->mdp_correcte()) {
                return 3;
            } else if ($_POST['mdp'] == $_POST['conf_mdp']) {
                return 4;
            } else {
                $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
                $sql = 'INSERT INTO Utilisateurs VALUES(NULL, ?, ?, 0, 1)';
                $statement = self::$bdd->prepare($sql);
                $statement->execute(array($_POST['login'], $mdp));
            }

        }

        private function mdp_correcte() {
            $containsLowerCaseLetter  = preg_match('/[a-z]/', $_POST['mdp']);
            $containsUpperCaseLetter  = preg_match('/[A-Z]/', $_POST['mdp']);
            $containsDigit   = preg_match('/\d/', $_POST['mdp']);
            $correctSize = strlen($_POST['mdp']) >= 8;
            return $containsLowerCaseLetter && $containsUpperCaseLetter && $containsDigit && $correctSize;
        }

        public function connexion() {
            if (!$this->verif_token())
                return 1;
            if (isset($_SESSION['login']))
                return 2;
            $sql = 'select * from Utilisateurs where login = ?';
            $verif_login = self::$bdd->prepare($sql);
            $verif_login->execute(array($_POST['login']));
            $infos = $verif_login->fetch();
            if ($verif_login->rowCount() == 0 || !password_verify($_POST['mdp'], $infos['password']))
                return 3;
            $_SESSION['login'] = $_POST['login'];
            $_SESSION['idUser'] = $infos['idUser'];
        }

        public function creation_token() {
            $bytes = random_bytes(20);
            $_SESSION['token'] = bin2hex($bytes);
            $_SESSION['token_date'] = time();
        }

        public function verif_token() {
            return strcmp($_POST['token'], $_SESSION['token']) == 0 && time() - $_SESSION['token_date'] < 900;
        }
    }
?>