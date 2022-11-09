<?php

    if (constant("lala") != "layn")
        die("wrong constant");

    include_once('connexion.php');

    class ModelePost extends Connexion {

        //Rajouter token
        //Inclure systeme verification d'insertion reussi
        public function redaction() {
            $titre_post = htmlspecialchars($_POST['titre_post']);
            $lien_post = htmlspecialchars($_POST['lien_post']);
            $corps_post = htmlspecialchars($_POST['corps_post']);
            
            $sql = 'INSERT INTO Posts VALUES(NULL, ?, ?, ?, now() ,?)';
            $statement = self::$bdd->prepare($sql);
            $statement->execute(array($lien_post, $titre_post, $corps_post,$_SESSION['idUser']));  

            $tag1 = ($_POST['tag1']);
            $tag2 = ($_POST['tag2']);
            $tag3 = ($_POST['tag3']);

            if ($tag1 == $tag2 || $tag1 == $tag3)
                $tag1 = "";
            if ($tag2 == $tag3)
                $tag2 = "";

            $statement = self::$bdd->prepare('SELECT idPost FROM Posts WHERE titre = :titre');
            $statement -> bindParam(':titre', $titre_post);
            $statement->execute();
            $idPost = $statement->fetch();
            
            self :: inserer_attrib_post($idPost["idPost"], $tag1);
            self :: inserer_attrib_post($idPost["idPost"], $tag2);
            self :: inserer_attrib_post($idPost["idPost"], $tag3);

            return $idPost["idPost"];
        }

        public function inserer_attrib_post($idPost, $tag) {
            if ($tag != "") {
                $statement = self::$bdd->prepare("INSERT INTO AttribuerPost VALUES(?, ?)");
                $statement->execute(array($idPost, $tag));
            }   
        }

        public function verif_titre() {
            $titre_post = htmlspecialchars($_POST['titre_post']);
            if ($titre_post == "" || $_POST['lien_post'] == "")
                return 3;
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

        public function get_commentaire() {
            $posts = self::$bdd->prepare('select CommenterPost.idUser as idUser, idPost, avis, login from CommenterPost join Utilisateurs on CommenterPost.idUser = Utilisateurs.idUser where idPost = ?');
            $posts->execute(array($_GET['idPost']));
            return $posts->fetchAll();
        }

        public function redac_tag($typeTag) {
            $statement = self::$bdd->prepare('SELECT nomTag, idTag FROM Tags WHERE typeTag = :typeT');
            $statement -> bindParam(':typeT', $typeTag);
            $statement->execute();
            $statement = $statement->fetchAll();
            return $statement;
        }

        public function supprimer_post() {
            $post = self::$bdd->prepare('delete from Posts where idPost = ?');
            $post->execute(array($_GET['idPost']));
        }

        public function redaction_commentaire() {
            $statement = self::$bdd->prepare("INSERT INTO CommenterPost VALUES(NULL,?, ?, ?)");
            $statement->execute(array($_GET['idPost'], $_SESSION['idUser'], $_POST['avis_commentaire']));
        }


    }
?>