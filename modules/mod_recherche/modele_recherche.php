<?php

if (constant("lala") != "layn")
    die("wrong constant");

include_once('modele_generique.php');

class ModeleRecherche extends ModeleGenerique
{
    public function recherche_users()
    {
        $users = self::$bdd->prepare('select idUser, login, pfp from Utilisateurs where login like :contenu limit 20');
        $users->execute(array(':contenu' => "%$_GET[contenu]%"));
        $users = $users->fetchAll();
        return $users;
    }

    public function verif_abonnement($users) {
        $verif_abo = array();
        if (count($users) > 0) {
            $sql = 'SELECT idUserAbonnement from Abonner where Abonner.idUserAbonne=? and Abonner.idUserAbonnement in (';
            for ($i = 0; $i < count($users) - 1; $i++) {
                $sql = $sql . $users[$i]['idUser'] . ",";
            }
            $sql = $sql . $users[$i]['idUser'] . ') order by Abonner.idUserAbonnement';
            $tab = self::$bdd->prepare($sql);
            $tab->execute(array($_SESSION['idUser']));
            $tab = $tab->fetchAll();

            $cpt = 0;
            for ($i = 0; $i < count($users); $i++) {
                if ($cpt < count($tab) && $users[$i]['idUser'] == $tab[$cpt]['idUserAbonnement']) {
                    $verif_abo[$i] = 2;
                    $cpt++;
                } else
                    $verif_abo[$i] = 1;
            }
        }
        return $verif_abo;
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
