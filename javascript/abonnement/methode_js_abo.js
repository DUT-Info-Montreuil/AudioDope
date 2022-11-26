$(function () {
    $(".div_bouton_abo").on('submit', '.form_abonnement', function (event) {
        event.preventDefault();
        abonnement(this);
    })

    $(".modal_abo_contenu").on('submit', '.form_abonnement', function (event) {
        event.preventDefault();
        abonnement(this);
        refresh_abonnement();
    })

    const modal_abonne = document.getElementById("modal_abonne");
    const btn_abonne = document.getElementsByClassName("voir_abonne")[0];

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
    const btn_abonnement = document.getElementsByClassName("voir_abonnement")[0];

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

function abonnement(form) {
    const formData = new FormData(form);
    $.ajax({
        type: "POST",
        url: $(form).attr("action"),
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        dataType: "json",
        success: function (data) {
            if (data != null) {
                document.getElementById('div_bouton_abo' + formData.get('idUser')).innerHTML = data['data'];
            }
        }
    })
}

function refresh_abonnement() {
    $.ajax({
        url: 'javascript/abonnement/refresh_abonnement.php',
        dataType: "json",
        success: function (data) {
            if (data != null) {
                document.getElementById('nb_abo').innerHTML = data['data'];
            }
        }
    })
}