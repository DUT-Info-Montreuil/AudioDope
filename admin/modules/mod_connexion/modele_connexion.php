<?php
/*AudioDope - Version 1.0 - 2022
GNU GPL CopyLeft 2022-2032
Hugo COHEN - Ayoub BOUAZIZ - Steven YANG*/
if (constant("lala") != "layn")
    die("wrong constant");

include_once('modele_generique.php');

class ModeleConnexion extends ModeleGenerique
{

    public function deconnexion()
    {
        unset($_SESSION['login']);
        unset($_SESSION['idUser']);
    }
    public function inscription()
    {
        if (!$this->verif_token())
            return 1;
        $login = htmlspecialchars($_POST['login']);
        $email = $_POST['email'];
        
        if (strlen($login) == 0 || filter_var($login, FILTER_VALIDATE_EMAIL))
            return 2;
        $verif_login = self::$bdd->prepare('select * from Utilisateurs where login = ?');
        $verif_login->execute(array($login));
        if ($verif_login->rowCount() > 0)
            return 2;

        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            return 3;
        $verif_email = self::$bdd->prepare('select * from Utilisateurs where email = ?');
        $verif_email->execute(array($email));
        if ($verif_email->rowCount() > 0)
            return 4;

        if (!$this->mdp_correcte())
            return 5;
    
        if ($_POST['mdp'] != $_POST['conf_mdp'])
            return 6;

        $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
        $sql = 'INSERT INTO Utilisateurs VALUES(NULL, ?, ?, ?, 0, 1, \'ressources/pfp/pfp.jpg\')';
        $statement = self::$bdd->prepare($sql);
        $statement->execute(array($login,$email, $mdp));
    }

    private function mdp_correcte()
    {
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
        $login = htmlspecialchars($_POST['login']);
        $verif_login = self::$bdd->prepare('select * from Utilisateurs where login = :login or email = :login');
        $verif_login->bindParam(':login', $login);
        $verif_login->execute();
        $infos = $verif_login->fetch();
        if ($verif_login->rowCount() == 0 || !password_verify($_POST['mdp'], $infos['password']))
            return 3;
        $_SESSION['login'] = $infos['login'];
        $_SESSION['idUser'] = $infos['idUser'];
    }

    public function get_email() {
        $email = self::$bdd->prepare('select email from Utilisateurs where login = ?');
        $email->execute(array($_SESSION['login']));
        return $email->fetch()['email'];
    }
}
