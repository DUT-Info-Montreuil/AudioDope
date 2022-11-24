function pas_connecte() {
    if (window.confirm("Connectez ou inscrivez-vous pour pouvoir voter. Souhaitez-vous connecter ?")) {
        window.open("index.php?module=connexion", "_self");
    }
}