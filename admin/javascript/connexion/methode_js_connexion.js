$(function () {
/*AudioDope - Version 1.0 - 2022
GNU GPL CopyLeft 2022-2032
Hugo COHEN - Ayoub BOUAZIZ - Steven YANG*/
    $("#form_email").submit(
        function (event) {
            event.preventDefault();
            const bouton = document.getElementById("bouton_email");
            if (bouton.value == 'Modifier') {
                bouton.value = "Valider";
                document.getElementById("input_email").disabled = false;
            } else {
                $.ajax({
                    type: "POST",
                    url: "javascript/connexion/changer_email.php",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function (data) {
                        if (data != null) {
                            document.getElementById("erreur_email").innerHTML = '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="alert"> <p>' + data['erreur'] + '</p></div>';
                        } else {
                            bouton.value = "Modifier";
                            document.getElementById("input_email").disabled = true;
                            document.getElementById("erreur_email").innerHTML = '<div class="alert alert-success alert-dismissible fade show" role="alert" id="alert"> <p>Email modifié avec succès</p></div>';
                        }
                    }
                })
            }
        });

    $("#form_mdp").submit(
        function (event) {
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: "javascript/connexion/changer_mdp.php",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    if (data != null) {
                        document.getElementById("erreur_mdp").innerHTML = '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="alert"> <p>' + data['erreur'] + '</p></div>';
                    } else {
                        document.getElementById("erreur_mdp").innerHTML = '<div class="alert alert-success alert-dismissible fade show" role="alert" id="alert"> <p>Mot de passe modifié avec succès</p></div>';
                    }
                    document.getElementById("mdp").value = "";
                    document.getElementById("nouv_mdp").value = "";
                    document.getElementById("conf_mdp").value = "";
                }
            })
        });
})