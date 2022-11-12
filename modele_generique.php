<?php

if (constant("lala") != "layn")
    die("wrong constant");

include_once('connexion.php');

class ModeleGenerique extends Connexion
{

    public function get_posts_complet($posts)
    {
        $votes = array();
        for ($i = 0; $i < count($posts); $i++) {
            $votes[$i] = $this->get_vote($posts[$i]['idPost']);
        }

        $nb_votes = array();
        for ($i = 0; $i < count($posts); $i++) {
            $nb_votes[$i] = $this->get_nb_votes($posts[$i]['idPost']);
        }

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

    public function get_nb_votes($idPost)
    {
        $upVotes = self::$bdd->prepare('select count(*) as count from VoterPost where idPost = ? and vote=1');
        $upVotes->execute(array($idPost));
        $upVotes = $upVotes->fetch()['count'];

        $downVotes = self::$bdd->prepare('select count(*) as count from VoterPost where idPost = ? and vote=-1');
        $downVotes->execute(array($idPost));
        $downVotes = $downVotes->fetch()['count'];

        return $upVotes - $downVotes;
    }
}
