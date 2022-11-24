<?php

    if (constant("lala") != "layn")
        die("wrong constant");

    include_once('vue_generique.php');

    class VueConnexion extends VueGenerique {
        
        public function __construct() {
            parent::__construct();
        }   

        public function menu() {
            echo "<a id=\"inscrire\" href=\"index.php?module=connexion&action=form_inscription\">S'inscrire</a><br/>";
        }

        public function form_inscription() {
            echo '<h1 id="titre_rouge">Inscription</h1>';

            if (isset($_GET['erreur'])) {
                if ($_GET['erreur'] == 2)
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="alert_insc"> <p>Nom d\'utilisateur indisponible</p> </div>';
                else if ($_GET['erreur'] == 3) {
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="alert_insc"> <p>8 caractères minimum avec au moins une lettre minuscule, 
                    une lettre majuscule et un chiffre</p> </div>';
                } else
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="alert_insc"> <p>Les mots de passes ne correspondent pas</p> </div>';
            }

            echo '
            <FORM ACTION="index.php?module=connexion&action=inscription" METHOD="POST" id="form_insc"> 
                <input type="hidden" name="token" value='.$_SESSION['token'].'>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                            </svg>
                        </span>
                    </div>
                    <INPUT id="insc_input" NAME="login" MAXLENGTH="20" placeholder="Nom d\'utilisateur" type="text" class="form-control"> 
                </div> 

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-unlock" viewBox="0 0 16 16">
                                <path d="M11 1a2 2 0 0 0-2 2v4a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h5V3a3 3 0 0 1 6 0v4a.5.5 0 0 1-1 0V3a2 2 0 0 0-2-2zM3 8a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1H3z"/>
                            </svg>
                        </span>
                    </div>
                    <INPUT id="insc_input" type="password" NAME="mdp" placeholder="Mot de passe" class="form-control"> 
                </div> 

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock" viewBox="0 0 16 16">
                                <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2zM5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1z"/>
                             </svg>
                        </span>
                    </div>
                    <INPUT id="insc_input" type="password" NAME="conf_mdp" placeholder="Confirmer mot de passe" class="form-control"> 
                </div> 

                <div class="alert alert-dark" role="alert">
                    <p>8 caractères minimum avec au moins une lettre minuscule, 
                    <br/>une lettre majuscule et un chiffre</p> 
                </div>

                <INPUT CLASS="btn btn-primary" TYPE="SUBMIT" NAME="bouton" value="S\'inscrire"> 
            </FORM>';

        }

        public function confirmation_inscription() {
            echo '<p>Inscription confirmée!</p>';
        }

        public function form_connexion() {
            echo '<h1 id="titre_rouge">Connexion</h1>';

            if (isset($_GET['erreur'])) {
                echo '<p>Nom d\'utilisateur ou mot de passe incorrecte</p>';
            }
            echo
            '<FORM ACTION="index.php?module=connexion&action=connexion" METHOD="POST" id="form_insc"> 
                <input type="hidden" name="token" value='.$_SESSION['token'].'>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                            </svg>
                        </span>
                    </div>
                    <INPUT id="insc_input" NAME="login" MAXLENGTH="20" placeholder="Nom d\'utilisateur" type="text" class="form-control">
                </div>
                
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-unlock" viewBox="0 0 16 16">
                                <path d="M11 1a2 2 0 0 0-2 2v4a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h5V3a3 3 0 0 1 6 0v4a.5.5 0 0 1-1 0V3a2 2 0 0 0-2-2zM3 8a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1H3z"/>
                            </svg>
                        </span>
                    </div>
                    <INPUT id="insc_input" type="password" NAME="mdp" placeholder="Mot de passe" class="form-control"> 
                </div> 

                <INPUT CLASS="btn btn-primary" id="bouton_connexion" TYPE="SUBMIT" NAME="bouton" value="Se connecter"> 
            </FORM>';
        }

        public function confirmation_connexion() {
            echo '<p>Connexion confirmée</p>';
        }

        public function confirmation_deconnexion() {
            echo '<p>Déconnexion confirmée</p>';
        }

        public function session_expiree() {
            echo "<p>Session expirée</p>";
        }
    }
?>