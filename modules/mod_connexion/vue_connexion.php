<?php

    if (constant("lala") != "layn")
        die("wrong constant");

    include_once('vue_generique.php');

    class VueConnexion extends VueGenerique {
        
        public function __construct() {
            parent::__construct();
        }   

        public function menu() {
            echo "<a href=\"index.php?module=connexion&action=form_inscription\">S'inscrire</a><br/>";
        }

        public function form_inscription() {
            echo '<h1>Inscription</h1>';

            if (isset($_GET['erreur'])) {
                if ($_GET['erreur'] == 2)
                    echo 'Nom d\'utilisateur indisponible';
                else if ($_GET['erreur'] == 3) {
                    echo '8 caractères minimum avec au moins une lettre minuscule, 
                    une lettre majuscule et un chiffre';
                } else
                    echo 'Les mots de passes ne correspondent pas';
            }

            echo '<FORM ACTION="index.php?module=connexion&action=inscription" METHOD="POST"> 
            <input type="hidden" name="token" value='.$_SESSION['token'].'>
            <p>Nom d\'utilisateur</p>
            <INPUT NAME="login" MAXLENGTH="50">
            <p>Mot de passe</p> 
            <INPUT type="password" NAME="mdp"> 
            <p>Confirmer mot de passe</p> 
            <INPUT type="password" NAME="conf_mdp"> 
            <p>8 caractères minimum avec au moins une lettre minuscule, 
            <br/>une lettre majuscule et un chiffre</p> 
            <INPUT CLASS="bouton_co_ins" TYPE="SUBMIT" NAME="bouton" value="s\'inscrire"> 
            </FORM>';
        }

        public function confirmation_inscription() {
            echo 'Inscription confirmée!';
        }

        public function form_connexion() {
            echo '<h1>Connexion</h1>';

            if (isset($_GET['erreur'])) {
                echo 'Nom d\'utilisateur ou mot de passe incorrecte';
            }

            echo'<FORM ACTION="index.php?module=connexion&action=connexion" METHOD="POST"> 
            <input type="hidden" name="token" value='.$_SESSION['token'].'>
            <p>Nom d\'utilisateur</p>
            <INPUT NAME="login" MAXLENGTH="50">
            <p>Mot de passe</p> 
            <INPUT type="password" NAME="mdp"> 
            <br/>
            <INPUT CLASS="bouton_co_ins" TYPE="SUBMIT" NAME="bouton" value="Se connecter"> 
            </FORM>';
        }

        public function confirmation_connexion() {
            echo 'Connexion confirmée';
        }

        public function confirmation_deconnexion() {
            echo 'Déconnexion confirmée';
        }

        public function session_expiree() {
            echo "Session expirée";
        }
    }
?>