<?php
    session_start();
    include_once('connexion.php');
	include_once('modules/mod_connexion/mod_connexion.php');
	include_once('composants/comp_menu/comp_menu.php');
	Connexion::initConnexion();
	$affichage;
	if (isset($_GET['module'])) {
		switch($_GET['module']) {
			case 'connexion' : new ModConnexion(); break;
			default : break;
		}
	}
	$menu = new CompMenu();
	include_once('template.php');
?>

