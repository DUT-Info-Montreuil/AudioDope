<?php


    if (constant("lala") != "layn")
        die("wrong constant");

    include_once('vue_generique.php');
    
    class VuePresentation extends VueGenerique{


        public function menu() {
            echo'
            <div id=slide_un>
                <div id="div_titre"><h1 class="titre titre1">Audio</h1><h1 class="titre titre2">Dope</h1></div>
                <h2> Partage et découvre, de l\'underground au mainstream </h2>
                
            </div>

            <div id=slide_deux>
                <h2 id="titre_pres"> Qui somme nous ?</h2>
                <p id="desc_pres"> AudioDope est un projet universitaire fondé par trois étudiants</p>
            </div>

            <div id=slide_trois>
                <h2 id="titre_pres"> Quel est le but ?</h2>
                <p id="desc_pres"> AudioDope est un site qui a pour but de vous faire découvrir de la musique. Aujourd\'hui les plateformes de straming enferment leurs utilisateurs dans leurs
                bulles. AudioDope a pour but de vous faire découvrir de nouveaux artistes, de nouveaux genres. En tant qu\'utilisateurs vous pouvez partagez n\'importe quel musique
                et en parler.
            </div>

            <div id =slide_quatre>
                <h2> </h2>
                <a id="titre_pres" href="index.php?module=connexion&action=form_inscription"> S\'inscrire </p>
            </div>';
        }

    
    }
