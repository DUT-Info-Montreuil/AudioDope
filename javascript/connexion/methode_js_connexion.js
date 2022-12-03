$(function () {
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
                            document.getElementById("erreur_email").innerHTML = "";
                        }
                    }
                })
            }
        });
})