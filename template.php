<!DOCTYPE HTML>
<HTML>
	<HEAD>
		<META CHARSET="UTF-8"/>
		<TITLE>MVC</TITLE>
		<LINK href="style.css" rel="stylesheet" type="text/css"> 
	</HEAD>
	<BODY>
		<HEADER>
			<?php
				global $menu;
				$menu->affichage();
			?>
		</HEADER>
		<MAIN>
			<?php
				global $affichage;
				echo $affichage;
			?>
		</MAIN>
		<FOOTER>
			<p>MVC - 2022 Tous droits réservés</p>
			<p>Mentions Légales · Politique de Protection des Données · Politique de cookies</p>
		</FOOTER>
	</BODY>
</HTML>