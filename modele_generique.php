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

    public function get_vote($idPost)
    {
        $vote = 0;
        if (isset($_SESSION['idUser'])) {
            $sql = self::$bdd->prepare('select vote from VoterPost where idUser = ? and idPost = ?');
            $sql->execute(array($_SESSION['idUser'], $idPost));
            if ($sql->rowcount() == 1)
                $vote = $sql->rowcount();
        }
        return $vote;
    }

    public function get_votes($posts)
    {
        $votes = array_fill(0, count($posts), 0);
        if (isset($_SESSION['idUser']) && count($posts) > 0) {
            //récupère toutes les votes de l'utilisateur dans une seule requête sql
            $sql = 'select VoterPost.idPost as idPost, vote from  Posts left join VoterPost on Posts.idPost = VoterPost.idPost where VoterPost.idUser = ? and VoterPost.idPost in (';
            for ($i = 0; $i < count($posts) - 1; $i++) {
                $sql = $sql . $posts[$i]['idPost'] . ",";
            }
            $sql = $sql . $posts[$i]['idPost'] . ') order by datePost desc';

            $tab = self::$bdd->prepare($sql);
            $tab->execute(array($_SESSION['idUser']));
            $tab = $tab->fetchAll();
            
            //associe les votes au posts correspondants
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
        if ($nb_vote == NULL)
            $nb_vote = 0;
        return $nb_vote;
    }

    public function get_nb_votes($posts, $order)
    {
        $nb_votes = array_fill(0, count($posts), 0);
        if (isset($_SESSION['idUser']) && count($posts) > 0) {
            $sql = 'select VoterPost.idPost as idPost, sum(vote) as sum from Posts left join VoterPost on Posts.idPost = VoterPost.idPost where VoterPost.idPost in (';
            for ($i = 0; $i < count($posts) - 1; $i++) {
                $sql = $sql . $posts[$i]['idPost'] . ",";
            }
            if ($order==0)
                $sql = $sql . $posts[$i]['idPost'] . ') group by VoterPost.idPost order by datePost desc';
            else
                $sql = $sql . $posts[$i]['idPost'] . ') group by VoterPost.idPost order by sum(vote) desc';

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

    public function get_tag($idPost)
    {
        $tags = array();
        $sql = self::$bdd->prepare('select idTag, nomTag from Tags natural join AttribuerPost where idPost = ? order by idTag');
        $sql->execute(array($idPost));
        if ($sql->rowcount() > 0)
            $tags = $sql->fetchAll();
        return $tags;
    }

    public function aimer_tag($tags) {
        $aimer_tags = array_fill(0, count($tags), 0);
        if (isset($_SESSION['idUser']) && count($tags) > 0) {
            $sql = 'select idTag from Apprecier where idUser = 6 and idTag in (';
            for ($i = 0; $i < count($tags) - 1; $i++) {
                $sql = $sql . $tags[$i]['idTag'] . ",";
            }
            $sql = $sql . $tags[$i]['idTag'] . ') order by idTag';

            $tab = self::$bdd->prepare($sql);
            $tab->execute(array($_SESSION['idUser']));
            if ($tab->rowcount() > 0) {
                $tab = $tab->fetchAll();
                for ($i = 0; $i < count($tab); $i++) {
                    $aimer_tags[$i] = $tab[$i]['idTag'];
                }
            }
        }
        return $aimer_tags;
    }

    public function aimer_tags($tags) {
        $aimer_tags = array();
        if (isset($_SESSION['idUser']) && count($tags) > 0) {
            $sql = 'select idTag from Apprecier where idUser = ? and idTag in (';
            for ($i = 0; $i < count($tags); $i++) {
                for ($j = 0; $j < count($tags[$i]); $j++) {
                    $sql = $sql . $tags[$i][$j]['idTag'] . ",";
                }
            }

            $sql = $sql . ') order by idTag';
            $sql = str_replace(',)', ')', $sql);

            $tab = self::$bdd->prepare($sql);
            $tab->execute(array($_SESSION['idUser']));
            if ($tab->rowcount() > 0) {
                $tab = $tab->fetchAll();
                for ($i = 0; $i < count($tab); $i++) {
                    $aimer_tags[$i] = $tab[$i]['idTag'];
                }
            }

        }
        return $aimer_tags;
    }

    public function get_tags($posts)
    {
        $tags = array_fill(0, count($posts), array());
        if (count($posts) > 0) {
            $sql = 'select idPost, idTag, nomTag from Tags natural join AttribuerPost natural join Posts where idPost in (';
            for ($i = 0; $i < count($posts) - 1; $i++) {
                $sql = $sql . $posts[$i]['idPost'] . ",";
            }
            $sql = $sql . $posts[$i]['idPost'] . ') order by datePost desc, idTag';
    
            $tab = self::$bdd->prepare($sql);
            $tab->execute();
            $tab = $tab->fetchAll();
            $cpt = 0;
            $taille = count($tab);

            //divise le tab en tableau de tableau pour mettre dans tags
            for ($i = 0; $i < count($posts); $i++) {
                $tmp = array();
                while ($cpt < $taille && $posts[$i]['idPost'] == $tab[$cpt]['idPost']) {
                    $tmp[] = $tab[$cpt];
                    unset($tab[$cpt]);
                    $cpt++;
                }
                $tags[$i] = $tmp;
            }
        }
        return $tags;
    }
}
