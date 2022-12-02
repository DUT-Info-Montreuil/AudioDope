<?php

if (constant("lala") != "layn")
    die("wrong constant");


include_once('/home/etudiants/info/aybouaziz/local_html/AudioDope/modele_generique.php');

class ModeleCollection extends ModeleGenerique 
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
    public function get_post_collection() {
        /*
        $sql = 'select Posts.idUser as idUser, Posts.idPost as idPost, login, pfp, lien, titre, descriptionPost, datePost from Collections inner join Appartenir using(idcollection) inner join Posts using(idPost) join Utilisateurs on Posts.idUser = Utilisateurs.idUser 
            where idCollection in (';
        $collection=self::$bdd->prepare('select idCollection from Collections where idCollection = ?');
        $collection->execute(array($_GET['idCollection']));
        

        for ($i = 0; $i < $collection->rowcount() - 1; $i++) {

        $sql = $sql . $collection->fetch()['idCollection'].',';
        }
        
        $sql = $sql . $collection->fetch()['idCollection'].')';
        $posts=self::$bdd->prepare($sql);
        $posts->execute(array($_GET['idCollection']));
*/

$sql = self::$bdd->prepare('select Posts.idUser as idUser,vote,Posts.idPost as idPost, login, pfp, lien, titre, descriptionPost, datePost from Collections inner join Appartenir using(idcollection) inner join Posts using(idPost) join Utilisateurs on Posts.idUser = Utilisateurs.idUser 
left join VoterPost on Posts.idPost = VoterPost.idPost where idCollection in (select idCollection from Collections where idCollection =?)');
 $sql->execute(array($_GET['idCollection']));           
        $posts=$sql->fetchAll();
        $tab=$this->get_posts_complet($posts);
        return $tab;

      
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

   
    public function getCollection()
    {
        $collections = self::$bdd->prepare('select Collections.idUser as idUser, idCollection, login, titreCollection, descriptionCollection, prive from Collections join Utilisateurs on Collections.idUser = Utilisateurs.idUser where idCollection = ?');
        $collections->execute(array($_GET['idCollection']));
        return $collections->fetch();
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

    public function supprimer_post_collection(){
        $supp_post=self::$bdd->prepare('delete from Appartenir where idPost=?');
        $supp_post->execute(array($_GET['idPost']));
    }
    

    public function rendre_collection_prive(){
        $prive =self::$bdd->prepare('update Collections set prive=1 where prive=0 and idCollection=?');
        $prive->execute(array($_GET['idCollection']));
        if(!$prive->fetch())
            return 1;
        return 2 ;
    }
    
}
