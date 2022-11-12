<?php

    if (constant("lala") != "layn")
        die("wrong constant");

    include_once('modele_generique.php');

    class ModelePost extends ModeleGenerique {

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
            $post = self::$bdd->prepare('select Posts.idUser as idUser, Posts.idPost as idPost, login, lien, titre, descriptionPost, datePost from Posts join Utilisateurs on Posts.idUser = Utilisateurs.idUser where Posts.idPost = ?');
            $post->execute(array($_GET['idPost']));
            $post = $post->fetch();

            $vote  = $this->get_vote($post['idPost']);
            $nb_votes = $this->get_nb_vote($post['idPost']);

            $tab = array(
                "post" => $post,
                "vote" => $vote,
                "nb_votes" => $nb_votes
            );

            return $tab;
        }

        public function voter() {
            if (isset($_SESSION['idUser'])) {
                $vote = self::$bdd->prepare('select vote from VoterPost where idUser = ? and idPost = ?');
                $vote->execute(array($_SESSION['idUser'], $_GET['idPost']));
                if ($vote->rowcount() == 0) {
                    echo 1;
                    $vote = self::$bdd->prepare('insert into VoterPost values (?,?,?)');
                    $vote->execute(array($_SESSION['idUser'], $_GET['vote'], $_GET['idPost']));
                } else if ($vote->fetch()['vote'] == $_GET['vote']) {
                    echo 2;
                    $vote = self::$bdd->prepare('delete from VoterPost where idUser = ? and idPost = ?');
                    $vote->execute(array($_SESSION['idUser'], $_GET['idPost']));
                } else {
                    echo 3;
                    $vote = self::$bdd->prepare('update VoterPost set vote = ? where idUser = ? and idPost = ?');
                    $vote->execute(array( $_GET['vote'], $_SESSION['idUser'], $_GET['idPost']));
                }
            }
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
    }
?>