<?php

    if (constant("lala") != "layn")
        die("wrong constant");

    include_once('vue_generique.php');

    class VueConnexion extends VueGenerique {
        
        public function __construct() {
            parent::__construct();
        }   

        public function menu() {
            echo "<a href=\"index.php?module=connexion&action=form_inscription\">s'inscrire</a><br/>";
        }

        public function form_inscription() {
            echo '<h1>Inscription</h1>';

            if (isset($_GET['erreur'])) {
                if ($_GET['erreur'] == 2)
                    echo 'erreur ! login indisponible';
                else if ($_GET['erreur'] == 3) {
                    echo 'i 8 caractères minimum avec au moins une lettre minuscule, 
                    une lettre majuscule, un chiffre et un caractère spécial';
                } else
                    echo 'erreur ! les mots de passe ne correspondent pas';
            }

            echo '<FORM ACTION="index.php?module=connexion&action=inscription" METHOD="POST"> 
            <input type="hidden" name="token" value='.$_SESSION['token'].'>
            <p>login</p>
            <INPUT NAME="login" MAXLENGTH="50">
            <p>mot de passe</p> 
            <INPUT type="password" NAME="mdp"> 
            <p>comfirmer le mot de passe</p> 
            <INPUT type="password" NAME="conf_mdp"> 
            <p>i 8 caractères minimum avec au moins une lettre minuscule, 
            <br/>une lettre majuscule, un chiffre et un caractère spécial</p> 
            <INPUT CLASS="bouton_co_ins" TYPE="SUBMIT" NAME="bouton" value="s\'inscrire"> 
            </FORM>';
        }

        public function confirmation_inscription() {
            echo 'inscription confirmée';
        }

        public function form_connexion() {
            echo '<h1>Connexion</h1>';

            if (isset($_GET['erreur'])) {
                echo 'login ou mot de passe incorrecte';
            }

            echo'<FORM ACTION="index.php?module=connexion&action=connexion" METHOD="POST"> 
            <input type="hidden" name="token" value='.$_SESSION['token'].'>
            <p>login</p>
            <INPUT NAME="login" MAXLENGTH="50">
            <p>mot de passe</p> 
            <INPUT type="password" NAME="mdp"> 
            <br/>
            <INPUT CLASS="bouton_co_ins" TYPE="SUBMIT" NAME="bouton" value="se connecter"> 
            </FORM>';
        }

        public function confirmation_connexion() {
            echo 'connexion confirmée';
        }

        public function confirmation_deconnexion() {
            echo 'deconnexion confirmée';
        }

        public function deja_connecte() {
            $login = htmlspecialchars($_SESSION['login']);
            echo "Vous êtes déjà connecté sous l’identifiant $login <a href=\"index.php?module=connexion&action=deconnexion\">Se déconnecter</a>";
        }

        public function session_expiree() {
            echo "session expirée";
        }
    }
?>