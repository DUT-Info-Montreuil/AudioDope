<?php
    /*AudioDope - Version 1.0 - 2022
GNU GPL CopyLeft 2022-2032
Hugo COHEN - Ayoub BOUAZIZ - Steven YANG*/

    if (constant("lala") != "layn")
        die("wrong constant");

    include_once('vue_generique.php');
    
    class VueMenu {
        
        private $affichage;

        public function menu() {
            $this->affichage = $this->affichage." <ul class=\"nav justify-content-center\" id=\"navbar\"> ";
            $this->affichage = $this->affichage."<li class=\"nav-item\">";
			if (isset($_SESSION['login'])) {
                $this->affichage = $this->affichage. "<a id=\"link_titre\" href=\"index.php?module=accueil&action=suivis\"><div id=\"div_titre\"><h1 class=\"titre titre1\">Audio </h1><h1 class=\"titre titre2\">Dope</h1></div></a>";
                $this->affichage = $this->affichage."<li class=\"nav-item\">".
                "<a class=\"nav-link\" href=\"index.php?module=post&action=form_redaction\">Rédiger un post</a></li>";
				$this->affichage = $this->affichage . "<li class=\"nav-item\">" .
                "<a class=\"nav-link\" href=\"index.php?module=collection&action=form_collection\">Créer une collection</a></li>".
                "<a class=\"nav-link\" href=\"index.php?module=profil&action=voir_profil&idUser=".$_SESSION['idUser']."\">Profil</a></li>";
                $this->affichage = $this->affichage . "<li class=\"nav-item\">" .
                '<a class="nav-link" href="index.php?module=connexion&action=parametres"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
                <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
              </svg></a></li>';
                $this->affichage = $this->affichage . "<li class=\"nav-item\">" .
                '<a class="nav-link" href="index.php?module=connexion&action=deconnexion"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
              </svg></a></li>';
			} else {
                $this->affichage = $this->affichage. "<a id=\"link_titre\" href=\"index.php?module=presentation\"><div id=\"div_titre\"><h1 class=\"titre titre1\">Audio </h1><h1 class=\"titre titre2\">Dope</h1></div></a>";
				$this->affichage = $this->affichage . "<li class=\"nav-item\">" . "<a class=\"nav-link\" href=\"index.php?module=connexion\">Se connecter</a></li>";
        	}
            $this->affichage = $this->affichage .  
            '<li class=\"nav-item\"> <div class=\"nav justify-content-center\" id="rechercher">
            <FORM id="form_recherche" action="index.php" METHOD="GET" enctype="multipart/form-data">
            <input type="hidden" name="module" value="recherche">
            <input type="hidden" name="action" value="recherche_post">
            <input type="hidden" name="filtre" value="tout">
                 <div class="form-outline">
                     <input type="search" name="contenu" class="form-control" placeholder="Rechercher" />
                </div>
                <button type="submit" id="bouton_recherche" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                    </svg>
                </button>
            </FORM>
            </div> </li>';
            $this->affichage = $this->affichage . " </ul> ";
        }

        public function affichage() {
            echo $this->affichage;
        }
    }
