<?php

if (constant("lala") != "layn")
    die("wrong constant");

include_once('connexion.php');

class ModeleCollection extends Connexion
{

    public function collection()
    {
        $titre_collection = htmlspecialchars($_POST['titre_collection']);
        $desciption_collection = htmlspecialchars($_POST['description_collection']);

        $sql = 'INSERT INTO Collections VALUES(Null,?, ?, 1 ,?)';
        $statement = self::$bdd->prepare($sql);
        $statement->execute(array($titre_collection, $desciption_collection, $_SESSION['idUser']));
        $tag1 = ($_POST['tag1']);
        $tag2 = ($_POST['tag2']);
        $tag3 = ($_POST['tag3']);
        if ($tag1 == $tag2 || $tag1 == $tag3)
            $tag1 = "";
        if ($tag2 == $tag3)
            $tag2 = "";

        $statement = self::$bdd->prepare('SELECT idCollection FROM Collections WHERE titre = :titre');
        $statement->bindParam(':titre', $titre_collection);
        $statement->execute();
        $idCollection = $statement->fetch();

        self::inserer_attrib_post($idCollection['idCollection'], $tag1);
        self::inserer_attrib_post($idCollection['idCollection'], $tag2);
        self::inserer_attrib_post($idCollection['idCollection'], $tag3);
    }
    public function inserer_attrib_post($idCollection, $tag)
    {
        if ($tag != "") {
            $statement = self::$bdd->prepare("INSERT INTO AttribuerCollection VALUES(?, ?)");
            $statement->execute(array($idCollection, $tag));
        }
    }
    public function redac_tag($typeTag)
    {
        $statement = self::$bdd->prepare('SELECT nomTag, idTag FROM Tags WHERE typeTag = :typeT');
        $statement->bindParam(':typeT', $typeTag);
        $statement->execute();
        $statement = $statement->fetchAll();
        return $statement;
    }
    public function verif_titre()
    {
        $titre_collection = htmlspecialchars($_POST['titre_collection']);
        if ($titre_collection == "")
            return 3;
        $statement = self::$bdd->prepare('SELECT titre FROM Collections WHERE titre = :titre');
        $statement->bindParam(':titre', $titre_collection);
        $statement->execute();
        $statement = $statement->fetch();
        if (!$statement)
            return 1;
        return 2;
    }

    public function supprimer_collection()
    {
        $collection = self::$bdd->prepare('delete from Collections where idCollection = ?');
        $collection->execute(array($_GET['idCollection']));
    }

    public function ajouter_post()
    {
        $collection = self::$bdd->prepare("INSERT INTO Appartenir (idPost, idCollection) VALUES (?, ?);");
        $collection->execute(array($_GET['idPost'],$_GET['idCollection']));
    }

    public function get_post_collection(){
        
        $postC=self::$bdd->prepare('select Posts.idPost, titre,Posts.idUser as idUser, idPost, login, lien, titre, descriptionPost, datePost, idCollection from Collections inner join Appartenir using(idCollection) inner join Posts using (idPost) inner join Utilisateurs on(Posts.idUser=Utilisateurs.idUser) where idCollection=?');
        $postC->execute(array($_GET['idCollection']));
        return $postC->fetchAll();
    }
    public function getCollection()
    {
        $collections = self::$bdd->prepare('select Collections.idUser as idUser, idCollection, login, titreCollection, descriptionCollection, prive from Collections join Utilisateurs on Collections.idUser = Utilisateurs.idUser where Collections.idUser = ?');
        $collections->execute(array($_GET['idCollection']));
        return $collections->fetchAll();
    }

    public function getChoixCollection(){
        $collections = self::$bdd->prepare('select Collections.idUser as idUser ,titreCollection , idCollection from Collections where Collections.idUser = ?');
        $collections->execute(array($_SESSION['idUser']));
       return $collections->fetchAll();
    }

    public function verif_post_dans_collection(){
        $post = self::$bdd->prepare('select * from Appartenir where idCollection=? and idPost=? ');
        $post-> execute(array($_GET['idCollection'],$_GET['idPost']));
        if(!$post->fetch()){
            return 1;
        }
        return 2;
        
    }
}
