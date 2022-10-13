<?php
    include_once('connexion.php');

    class ModeleConnexion extends Connexion {

        public function inscription() {
            if (!$this->verif_token())
                return 1;
            $verif_login = self::$bdd->prepare('select * from utilisateurs where login = ?');
            $verif_login->execute(array($_POST['login']));
            if ($verif_login->rowCount() > 0) {
                return 2;
            } else if (!$this->mdp_correcte()) {
                return 3;
            } else if (strcmp($_POST['mdp'],$_POST['conf_mdp']) != 0) {
                return 4;
            } else {
                $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
                $sql = 'INSERT INTO utilisateurs VALUES(NULL, ?, ?)';
                $statement = self::$bdd->prepare($sql);
                $statement->execute(array($_POST['login'], $mdp));
            }

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
            if (!$this->verif_token())
                return 1;
            $sql = 'select * from utilisateurs where login = ?';
            $verif_login = self::$bdd->prepare($sql);
            $verif_login->execute(array($_POST['login']));
            if ($verif_login->rowCount() == 0 || !password_verify($_POST['mdp'], $verif_login->fetch()['motDePasse'])) {
                return 2;
            } else if (isset($_SESSION['login'])) {
                return 3;
            }
            $_SESSION['login'] = $_POST['login'];
        }

        public function creation_token() {
            $bytes = random_bytes(20);
            $_SESSION['token'] = bin2hex($bytes);
            $_SESSION['token_time'] = time();
        }

        public function verif_token() {
            return strcmp($_POST['token'], $_SESSION['token']) == 0 && time() - $_SESSION['token_time'] < 900;
        }
    }
?>