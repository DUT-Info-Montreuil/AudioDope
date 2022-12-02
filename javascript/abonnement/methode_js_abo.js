$(function () {
    // GNU GPL Copyleft 2022 
    const btn = document.getElementsByClassName("close");
    const modal = document.getElementsByClassName("modal");

    btn[0].onclick = function () {
        modal[0].style.display = "none";
    }

    btn[1].onclick = function () {
        modal[1].style.display = "none";
    }

    //bouton abonnement dynamique
    $(".div_bouton_abo").on('submit', '.form_abonnement', function (event) {
        event.preventDefault();
        abonnement(this);
    })

    $(".modal_abo_contenu").on('submit', '.form_abonnement', function (event) {
        event.preventDefault();
        abonnement(this);
    })

    const modal_abo = document.getElementById("modal_abo");

    //abonne
    const btn_abonne = document.getElementsByClassName("voir_abonne")[0];

    btn_abonne.onclick = function () {
        afficher_abonne();
        modal_abo.style.display = "flex";
    }

    //abonnement
    const btn_abonnement = document.getElementsByClassName("voir_abonnement")[0];

    btn_abonnement.onclick = function () {
        afficher_abonnement();
        modal_abo.style.display = "flex";
    }

    $(".modal_abo_contenu").on('click', '.voir_abonnement', function () {
        afficher_abonnement();
        modal_abo.style.display = "flex";
    })

    $(".modal_abo_contenu").on('click', '.voir_abonne', function () {
        afficher_abonne();
        modal_abo.style.display = "flex";
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
            document.getElementById("modal_abo_body").innerHTML = data['string'];
        }
    })
}

function afficher_abonne() {
    $.ajax({
        url: "javascript/abonnement/voir_abonnes.php",
        dataType: "json",
        success: function (data) {
            document.getElementById("modal_abo_body").innerHTML = data['string'];
        }
    })
}