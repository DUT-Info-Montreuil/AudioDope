$(function () {
    $(".div_bouton_abo").on( 'submit', '.form_desabonner',
        function (event) {
            event.preventDefault();
            const formData = new FormData(this);
            $.ajax({
                type: "POST",
                url: "javascript/abonnement/desabonner.php",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    if (data != null)
                        document.getElementById('div_bouton_abo' + formData.get('idUser')).innerHTML = data['data'];
                }
            })
        });

    $(".div_bouton_abo").on( 'submit', '.form_abonner',
        function (event) {
            event.preventDefault();
            const formData = new FormData(this);
            $.ajax({
                type: "POST",
                url: "javascript/abonnement/abonner.php",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    if (data != null)
                        document.getElementById('div_bouton_abo' + formData.get('idUser')).innerHTML = data['data'];
                }
            })
        })
    
    const modal_abonne = document.getElementById("modal_abonne");
    const btn_abonne = document.getElementById("voir_abonne");

    btn_abonne.onclick = function () {
        $.ajax({
            url: "javascript/abonnement/voir_abonnes.php",
            dataType: "json",
            success: function (data) {
                document.getElementsByClassName("modal_abo_contenu")[0].innerHTML = data['string'];
            }
        })
        modal_abonne.style.display = "flex";
    }

    const modal_abonnement = document.getElementById("modal_abonnement");
    const btn_abonnement = document.getElementById("voir_abonnement");

    btn_abonnement.onclick = function () {
        $.ajax({
            url: "javascript/abonnement/voir_abonnements.php",
            dataType: "json",
            success: function (data) {
                document.getElementsByClassName("modal_abo_contenu")[1].innerHTML = data['string'];
            }
        })
        modal_abonnement.style.display = "flex";
    }
});