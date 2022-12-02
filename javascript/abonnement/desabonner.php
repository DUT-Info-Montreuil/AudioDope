<?php
// GNU GPL Copyleft 2022 
    session_start();
    header('Content-type: application/json; charset=utf-8');
    
    if (isset($_SESSION['idUser'])) {
        $bdd = new PDO ('mysql:host='."database-etudiants.iut.univ-paris8.fr".';dbname='."dutinfopw201625", "dutinfopw201625", "razamaqe");
        $sql = $bdd->prepare('DELETE FROM Abonner where Abonner.idUserAbonne=? and Abonner.idUserAbonnement=?');
        $sql->execute(array($_SESSION['idUser'], $_POST['idUser']));
        $data = array (
            "data" => '<FORM class="form_abonnement" ACTION="javascript/abonnement/abonner.php" METHOD="POST"> 
            <input type="hidden" name="token" value='.$_SESSION['token'].'>
            <input type="hidden" name="idUser" value='.$_POST['idUser'].'>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
            </svg>
            <INPUT CLASS="btn btn-primary" TYPE="SUBMIT" NAME="bouton" value="S\'abonner"> 
            </FORM>'
        );

        echo json_encode($data);
    }
?>