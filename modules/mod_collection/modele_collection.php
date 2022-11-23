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

    public function ajouter_post($idPost)
    {
        $collection = self::$bdd->prepare("INSERT INTO Appartenir VALUES(?, ?)");
        $collection->execute(array($idPost, $_GET['idCollection']));
    }

    public function get_post_collection(){
        $postC=self::$bdd->prepare('select idPost, titre, idCollection from Collections inner join Appartenir using(idCollection) inner join Posts using (idPost) where idCollection=?');
        $postC->execute(array($_GET['idCollection']));
        return $postC->fetchAll();
    }

    public function getCollection()
    {
        $collections = self::$bdd->prepare('select Collections.idUser as idUser, idCollection, login, titreCollection, descriptionCollection, prive from Collections join Utilisateurs on Collections.idUser = Utilisateurs.idUser where idCollection = ?');
        $collections->execute(array($_SESSION['idUser']));
        return $collections->fetchAll();
    }
}
