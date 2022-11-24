<?php

if (constant("lala") != "layn")
    die("wrong constant");

include_once('connexion.php');

class ModeleGenerique extends Connexion
{

    public function creation_token() {
        $bytes = random_bytes(20);
        $_SESSION['token'] = bin2hex($bytes);
        $_SESSION['token_date'] = time();
    }

    public function verif_token() {
        return $_POST['token'] == $_SESSION['token'] && time() - $_SESSION['token_date'] < 900;
    }
    
    public function get_posts_complet($posts)
    {
        $votes = array();
        
        if (count($posts) > 0)
            $votes = $this->get_votes($posts);

        $nb_votes = array();
        if (count($posts) > 0)
            $nb_votes = $this->get_nb_votes($posts);

        $tab = array(
            "posts" => $posts,
            "votes" => $votes,
            "nb_votes" => $nb_votes
        );

        return $tab;
    }

    public function get_vote($idPost)
    {
        if (isset($_SESSION['idUser'])) {
            $vote = self::$bdd->prepare('select vote from VoterPost where idUser = ? and idPost = ?');
            $vote->execute(array($_SESSION['idUser'], $idPost));
            if ($vote->rowcount() == 1)
                $vote = $vote->fetch()['vote'];
            else
                $vote = 0;
        } else
            $vote = 0;
        return $vote;
    }

    public function get_votes($posts)
    {
        $votes = array_fill(0, count($posts), 0);
        if (isset($_SESSION['idUser'])) {
            $sql = 'select VoterPost.idPost as idPost, vote from  Posts left join VoterPost on Posts.idPost = VoterPost.idPost where VoterPost.idUser = ? and VoterPost.idPost in (';
            for ($i = 0; $i < count($posts) - 1; $i++) {
                $sql = $sql . $posts[$i]['idPost'] . ",";
            }
            $sql = $sql . $posts[$i]['idPost'] . ') order by datePost desc';

            $tab = self::$bdd->prepare($sql);
            $tab->execute(array($_SESSION['idUser']));
            $tab = $tab->fetchAll();

            $cpt = 0;
            for ($i = 0; $i < count($posts) && $cpt < count($tab); $i++) {
                if ($posts[$i]['idPost'] == $tab[$cpt]['idPost'])
                    $votes[$i] = $tab[$cpt++]['vote'];
            }
        }
        return $votes;
    }

    public function get_nb_vote($idPost)
    {
        $nb_vote = self::$bdd->prepare('select sum(vote) as sum from VoterPost where idPost = ?');
        $nb_vote->execute(array($idPost));
        $nb_vote = $nb_vote->fetch()['sum'];
        return $nb_vote;
    }

    public function get_nb_votes($posts)
    {
        $nb_votes = array_fill(0, count($posts), 0);
        if (isset($_SESSION['idUser'])) {
            $sql = 'select VoterPost.idPost as idPost, sum(vote) as sum from Posts left join VoterPost on Posts.idPost = VoterPost.idPost where VoterPost.idPost in (';
            for ($i = 0; $i < count($posts) - 1; $i++) {
                $sql = $sql . $posts[$i]['idPost'] . ",";
            }
            $sql = $sql . $posts[$i]['idPost'] . ') group by VoterPost.idPost order by datePost desc';

            $tab = self::$bdd->prepare($sql);
            $tab->execute(array($_SESSION['idUser']));
            $tab = $tab->fetchAll();

            $cpt = 0;
            for ($i = 0; $i < count($posts) && $cpt < count($tab); $i++) {
                if ($posts[$i]['idPost'] == $tab[$cpt]['idPost'])
                    $nb_votes[$i] = $tab[$cpt++]['sum'];
            }

        }
        return $nb_votes;
    }
}
