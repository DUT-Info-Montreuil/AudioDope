<script src="https://code.jquery.com/jquery-3.6.1.min.js"
integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="
crossorigin="anonymous"></script>
<script src="javascript/methode_js.js"></script>

<?php
    session_start();

	define ("lala", "layn");

    include_once('connexion.php');
	include_once('modules/mod_connexion/mod_connexion.php');
	include_once('modules/mod_profil/mod_profil.php');
	include_once('modules/mod_post/mod_post.php');
	include_once('modules/mod_accueil/mod_accueil.php');
	include_once('composants/comp_menu/comp_menu.php');
	Connexion::initConnexion();
	$affichage;
	if (isset($_GET['module'])) {
		switch($_GET['module']) {
			case 'connexion' : new ModConnexion(); break;
			case 'profil' : new ModProfil(); break;
			case 'post' : new ModPost(); break;
			case 'accueil' : new ModAccueil(); break;
			default : die("module inconnu");
		}
	}
	$menu = new CompMenu();
	include_once('template.php');
?>

