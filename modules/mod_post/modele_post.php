<?php

    if (constant("lala") != "layn")
        die("wrong constant");

    include_once('connexion.php');

    class ModelePost extends Connexion {

        //Rajouter token
        //Inclure systeme verification d'insertion reussi
        //Inclure verification de titre vide ou déja pris
        //empecher de poster si lien vide
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

            $sql =  "INSERT INTO AttribuerPost VALUES(?, ?);
                    INSERT INTO AttribuerPost VALUES(?, ?);
                    INSERT INTO AttribuerPost VALUES(?, ?);";
            $statement = self::$bdd->prepare($sql);
            $statement->execute(array($idPost["idPost"], $tag1, $idPost["idPost"], $tag2, $idPost["idPost"], $tag3));
            
    
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

        public function redac_tag($typeTag) {
            $statement = self::$bdd->prepare('SELECT nomTag, idTag FROM Tags WHERE typeTag = :typeT');
            $statement -> bindParam(':typeT', $typeTag);
            $statement->execute();
            $statement = $statement->fetchAll();
            return $statement;

        }
    }
?>