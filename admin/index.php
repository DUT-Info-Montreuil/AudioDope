<script src="https://code.jquery.com/jquery-3.6.1.min.js"
integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="
crossorigin="anonymous"></script>
<script src="javascript/methode_js.js"></script>
<script src="javascript/profil/methode_js_profil.js"></script>
<script src="javascript/abonnement/methode_js_abo.js"></script>
<script src="javascript/post/methode_js_post.js"></script>
<script src="javascript/tags/methode_js_tags.js"></script>
<script src="javascript/connexion/methode_js_connexion.js"></script>
<script src="javascript/collection/methode_js_collection.js"></script>
<script src="javascript/collection/methode_js_post_collections.js"></script>

<?php
/*AudioDope - Version 1.0 - 2022
GNU GPL CopyLeft 2022-2032
Hugo COHEN - Ayoub BOUAZIZ - Steven YANG*/

    session_start();

	define ("lala", "layn");

    include_once('connexion.php');
	include_once('modules/mod_connexion/mod_connexion.php');
	include_once('modules/mod_profil/mod_profil.php');
	include_once('modules/mod_post/mod_post.php');
	include_once('modules/mod_accueil/mod_accueil.php');
	include_once('modules/mod_recherche/mod_recherche.php');
	include_once('modules/mod_presentation/mod_presentation.php');
	include_once('composants/comp_menu/comp_menu.php');
	include_once('modules/mod_collection/mod_collection.php');
	Connexion::initConnexion();
	Connexion::verif_admin();
	$affichage;
	
	if (isset($_GET['module'])) {
		switch($_GET['module']) {
			case 'connexion' : new ModConnexion(); break;
			case 'profil' : new ModProfil(); break;
			case 'post' : new ModPost(); break;
			case 'accueil' : new ModAccueil(); break;
			case 'recherche' : new ModRecherche(); break;
			case 'presentation' : new ModPresentation(); break;
			case 'collection' : new ModCollection(); break;
			default : die("module inconnu");
		}
	} else {
		if (isset($_SESSION['login'])) {
			new ModAccueil(); 
		} else {
			new ModPresentation();
		}
	}
	$menu = new CompMenu();
	include_once('template.php');
?>

