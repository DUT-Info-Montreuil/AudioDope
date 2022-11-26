$(function () {
    //bouton abonnement dynamique
    $(".div_bouton_abo").on('submit', '.form_abonnement', function (event) {
        event.preventDefault();
        abonnement(this);
    })

    $(".modal_abo_contenu").on('submit', '.form_abonnement', function (event) {
        event.preventDefault();
        abonnement(this);
    })

    //abonne
    const modal_abonne = document.getElementById("modal_abonne");
    const btn_abonne = document.getElementsByClassName("voir_abonne")[0];

    btn_abonne.onclick = function () {
        afficher_abonne();
        modal_abonne.style.display = "flex";
    }

    //abonnement
    const modal_abonnement = document.getElementById("modal_abonnement");
    const btn_abonnement = document.getElementsByClassName("voir_abonnement")[0];

    btn_abonnement.onclick = function () {
        afficher_abonnement();
        modal_abonnement.style.display = "flex";
    }

    $(".modal_abo_contenu").on('click', '.voir_abonnement', function () {
        modal_abonne.style.display = "none";
        afficher_abonnement();
        modal_abonnement.style.display = "flex";
    })

    $(".modal_abo_contenu").on('click', '.voir_abonne', function () {
        modal_abonnement.style.display = "none";
        afficher_abonne();
        modal_abonne.style.display = "flex";
    })
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

function afficher_abonnement() {
    $.ajax({
        url: "javascript/abonnement/voir_abonnements.php",
        dataType: "json",
        success: function (data) {
            document.getElementsByClassName("modal_abo_contenu")[1].innerHTML = data['string'];
        }
    })
}

function afficher_abonne() {
    $.ajax({
        url: "javascript/abonnement/voir_abonnes.php",
        dataType: "json",
        success: function (data) {
            document.getElementsByClassName("modal_abo_contenu")[0].innerHTML = data['string'];
        }
    })
}