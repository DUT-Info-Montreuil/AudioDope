<?php


    if (constant("lala") != "layn")
        die("wrong constant");

    include_once('vue_generique.php');
    
    class VueMenu {
        
        private $affichage;

        public function menu() {
            $this->affichage = $this->affichage." <ul class=\"nav justify-content-center\" id=\"navbar\"> ";
            $this->affichage = $this->affichage."<li class=\"nav-item\">".
            "<a href=\"index.php?module=accueil\"><div id=\"div_titre\"><h1 class=\"titre titre1\">Audio</h1><h1 class=\"titre titre2\">Dope</h1></div></a>";
			if (isset($_SESSION['login'])) {
                $this->affichage = $this->affichage."<li class=\"nav-item\">".
                "<a class=\"nav-link\" href=\"index.php?module=post&action=form_redaction\">Rédiger un post</a></li>";
				$this->affichage = $this->affichage . "<li class=\"nav-item\">" .
                "<a class=\"nav-link\" href=\"index.php?module=profil&action=voir_profil&idUser=".$_SESSION['idUser']."\">Profil</a></li>";
                $this->affichage = $this->affichage . "<li class=\"nav-item\">" .
                "<a class=\"nav-link\" href=\"index.php?module=connexion&action=deconnexion\">Se déconnecter</a></li>";
			} else {
				$this->affichage = $this->affichage . "<li class=\"nav-item\">" . "<a class=\"nav-link\" href=\"index.php?module=connexion\">Se connecter</a></li>";
        	}
            $this->affichage = $this->affichage .  
            '<div class=\"nav justify-content-center\" id="rechercher">
            <FORM id="form_recherche" action="index.php" METHOD="GET" enctype="multipart/form-data">
            <input type="hidden" name="module" value="recherche">
            <input type="hidden" name="action" value="section_tout">
                 <div class="form-outline">
                     <input type="search" name="contenu" class="form-control" placeholder="Rechercher" />
                </div>
                <button type="submit" id="bouton_recherche" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                    </svg>
                </button>
            </FORM>
            </div>';
            $this->affichage = $this->affichage . " </ul> ";
        }

        public function affichage() {
            echo $this->affichage;
        }
    }
