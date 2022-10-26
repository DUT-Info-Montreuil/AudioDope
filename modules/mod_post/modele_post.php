<?php

    if (constant("lala") != "layn")
        die("wrong constant");

    include_once('connexion.php');

    class ModelePost extends Connexion {

        //Rajouter token
        //Inclure systeme verification d'insertion reussi
        //Inclure verification de titre vide ou déja pris
        public function redaction() {
            $titre_post = htmlspecialchars($_POST['titre_post']);
            $lien_post = htmlspecialchars($_POST['lien_post']);
            $corps_post = htmlspecialchars($_POST['corps_post']);
            
            $sql = 'INSERT INTO Posts VALUES(NULL, ?, ?, ?, now() ,?)';
            $statement = self::$bdd->prepare($sql);
            $statement->execute(array($lien_post, $titre_post, $corps_post,$_SESSION['idUser']));  
        }

        public function verif_titre() {
            $titre_post = htmlspecialchars($_POST['titre_post']);
            $statement = self::$bdd->prepare('SELECT titre FROM Posts WHERE titre = :titre');
            $statement -> bindParam(':titre', $titre_post);
            $statement->execute();
            $statement = $statement->fetch();
            if (!$statement)
                return 1;
            return 2;
        }
        
        public function get_post() {
            $posts = self::$bdd->prepare('select Posts.idUser as idUser, idPost, login, lien, titre, descriptionPost, datePost from Posts join Utilisateurs on Posts.idUser = Utilisateurs.idUser where idPost = ?');
            $posts->execute(array($_GET['idPost']));
            return $posts->fetch();
        }

    }
?>