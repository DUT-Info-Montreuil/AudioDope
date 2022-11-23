<?php
if (constant("lala") != "layn")
	die("wrong constant");
?>


<!DOCTYPE HTML>
<HTML>

<HEAD>
	<META CHARSET="UTF-8" />
	<TITLE>AudioDope</TITLE>
	<LINK href="style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</HEAD>

<BODY>
	<HEADER>
		<?php
		global $menu;
		$menu->affichage();
		?>
	</HEADER>
		<MAIN id="main">
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