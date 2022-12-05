<?php
/*AudioDope - Version 1.0 - 2022
GNU GPL CopyLeft 2022-2032
Hugo COHEN - Ayoub BOUAZIZ - Steven YANG*/
if (constant("lala") != "layn")
    die("wrong constant");

include_once('modele_profil.php');
include_once('vue_profil.php');

class ContProfil
{

    private $modele;
    private $vue;
    private $action;

    public function __construct()
    {
        $this->modele = new ModeleProfil();
        $this->vue = new VueProfil();
        $this->action = isset($_GET['action']) ? $_GET['action'] : "";
    }

    public function voir_profil()
    {
        $profil = $this->modele->getProfil();
        if (isset($_SESSION['idUser']) && $profil['idUser'] == $_SESSION['idUser'])
            $this->vue->afficher_profil_perso($profil);
        else {
            $this->vue->afficher_profil($profil);
            $val = $this->modele->verif_abonnement($_GET['idUser']);
            if ($val == 2) {
                $this->vue->afficherform_desabonnement($profil['idUser']);
            } else if ($val == 1) {
                $this->vue->afficherform_abonnement($profil['idUser']);
            }
        }
        $this->vue->menu();
        if (isset($_GET['section']) && $_GET['section'] == 'collections') {
            $this->vue->indic_section('section_collections');
            $this->vue->affiche_collections($this->modele->getCollection());
        } else {
            $this->vue->indic_section('section_posts');
            $posts = $this->modele->get_posts();
            $votes  = $this->modele->get_votes($posts);
            $nb_votes = $this->modele->get_nb_votes($posts, 0);
            $tags = $this->modele->get_tags($posts);
            $aimer_tags = $this->modele->aimer_tags($tags);
            $this->vue->affiche_posts($posts, $votes, $nb_votes, $tags, $aimer_tags);
        }
    }

    public function exec()
    {
        switch ($this->action) {
            case 'voir_profil':
                $this->voir_profil();
                break;
            default:
                die("action inexistant");
        }
        $this->vue->affichage();
    }
}
