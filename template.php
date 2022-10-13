<!DOCTYPE HTML>
<HTML>
	<HEAD>
		<META CHARSET="UTF-8"/>
		<TITLE>AudioDope</TITLE>
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
			<p>AudioDope - 2022 Tous droits réservés</p>
			<p>Mentions Légales · Politique de Protection des Données · Politique de cookies</p>
		</FOOTER>
	</BODY>
</HTML>