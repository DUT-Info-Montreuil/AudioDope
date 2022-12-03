<?php
// GNU GPL Copyleft 2022 
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
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="alert_insc"> <p>';
                switch($_GET['erreur']) {
                    case 2: echo 'Nom d\'utilisateur indisponible'; break;
                    case 3: echo 'L\'adressse e-mail est invalide'; break;
                    case 4: echo 'L\'adresse e-mail est déjà utilisée'; break;
                    case 5: echo '8 caractères minimum avec au moins une lettre minuscule, une lettre majuscule et un chiffre'; break;
                    case 6: echo 'Les mots de passes ne correspondent pas'; break;
                };
                echo '</p> </div>';
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
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-at" viewBox="0 0 16 16">
                                <path d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2H2Zm3.708 6.208L1 11.105V5.383l4.708 2.825ZM1 4.217V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2-7-4.2Z"/>
                                <path d="M14.247 14.269c1.01 0 1.587-.857 1.587-2.025v-.21C15.834 10.43 14.64 9 12.52 9h-.035C10.42 9 9 10.36 9 12.432v.214C9 14.82 10.438 16 12.358 16h.044c.594 0 1.018-.074 1.237-.175v-.73c-.245.11-.673.18-1.18.18h-.044c-1.334 0-2.571-.788-2.571-2.655v-.157c0-1.657 1.058-2.724 2.64-2.724h.04c1.535 0 2.484 1.05 2.484 2.326v.118c0 .975-.324 1.39-.639 1.39-.232 0-.41-.148-.41-.42v-2.19h-.906v.569h-.03c-.084-.298-.368-.63-.954-.63-.778 0-1.259.555-1.259 1.4v.528c0 .892.49 1.434 1.26 1.434.471 0 .896-.227 1.014-.643h.043c.118.42.617.648 1.12.648Zm-2.453-1.588v-.227c0-.546.227-.791.573-.791.297 0 .572.192.572.708v.367c0 .573-.253.744-.564.744-.354 0-.581-.215-.581-.8Z"/>
                            </svg>
                        </span>
                    </div>
                    <INPUT id="insc_input" NAME="email" MAXLENGTH="254" placeholder="Adresse email" type="text" class="form-control"> 
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
                    <INPUT id="insc_input" type="password" NAME="conf_mdp" placeholder="Confirmer le mot de passe" class="form-control"> 
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