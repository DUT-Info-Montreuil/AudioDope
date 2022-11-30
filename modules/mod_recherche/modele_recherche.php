<?php

if (constant("lala") != "layn")
    die("wrong constant");

include_once('modele_generique.php');

class ModeleRecherche extends ModeleGenerique
{
    public function recherche_users() {
        $users = self::$bdd->prepare('select idUser, login from Utilisateurs where login like :contenu desc limit 20');
        $users->execute(array(':contenu' => "%$_GET[contenu]%"));
        $users = $users->fetchAll();
        return $users;
    }

    public function recherche_posts()
    {
        $posts = self::$bdd->prepare('select idUser, idPost, login, pfp, lien, titre, descriptionPost, datePost from Posts natural join Utilisateurs where idPost in (select idPost from AttribuerPost natural join Tags where nomTag like :contenu) or titre like :contenu or descriptionPost like :contenu or login like :contenu order by datePost desc limit 20');
        $posts->execute(array(':contenu' => "%$_GET[contenu]%"));
        $posts = $posts->fetchAll();
        return $posts;
    }
    
    public function recherche_par_tag()
    {
        $posts = self::$bdd->prepare('select idUser, idPost, login, pfp, lien, titre, descriptionPost, datePost from Posts natural join Utilisateurs where idPost in (select idPost from AttribuerPost natural join Tags where nomTag like ?) order by datePost desc limit 20');
        $posts->execute(array("%$_GET[contenu]%"));
        $posts = $posts->fetchAll();
        return $posts;
    }
    
    public function recherche_par_titre()
    {
        $posts = self::$bdd->prepare('select idUser, idPost, login, pfp, lien, titre, descriptionPost, datePost from Posts natural join Utilisateurs where titre like ? order by datePost desc limit 20');
        $posts->execute(array("%$_GET[contenu]%"));
        $posts = $posts->fetchAll();
        return $posts;
    }

    public function recherche_par_description()
    {
        $posts = self::$bdd->prepare('select idUser, idPost, login, pfp, lien, titre, descriptionPost, datePost from Posts natural join Utilisateurs where descriptionPost like ? order by datePost desc limit 20');
        $posts->execute(array("%$_GET[contenu]%"));
        $posts = $posts->fetchAll();
        return $posts;
    }

    public function recherche_par_user()
    {
        $posts = self::$bdd->prepare('select idUser, idPost, login, pfp, lien, titre, descriptionPost, datePost from Posts natural join Utilisateurs where login like ? order by datePost desc limit 20');
        $posts->execute(array("%$_GET[contenu]%"));
        $posts = $posts->fetchAll();
        return $posts;
    }
}
