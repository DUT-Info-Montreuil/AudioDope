<?php

    if (constant("lala") != "layn")
        die("wrong constant");

    include_once('connexion.php');

    class ModeleAccueil extends Connexion {
        
        public function get_recent() {
            $posts = self::$bdd->prepare('select login, lien, titre, descriptionPost, datePost from Posts join Utilisateurs on Posts.idUser = Utilisateurs.idUser order by datePost desc limit 20');
            $posts->execute();
            return $posts->fetchAll();
        }
    }
?>