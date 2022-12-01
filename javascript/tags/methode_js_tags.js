$(function () {

    $(".aimer_tag").on('click', '.liker_tag', function () {
        const idTag = $(this).attr("idTag");
        $.ajax({
            type: "GET",
            url: "javascript/tags/liker_tag.php",
            data: {
                idTag: idTag
            },
            dataType: "json",
            success: function (data) {
                if (data['connecte'] == false) {
                    pas_connecte();
                } else {
                    const boutons = document.getElementsByClassName('aimer_' + idTag);
                    Array.prototype.forEach.call(boutons, function (bouton) {
                            bouton.innerHTML = '<button type="button" class="like_tag deliker_tag" idTag="'+ idTag + '" href="#"><img src="ressources/coeurs/coeur_plein.png" alt="logo like plein"></button type="button">';
                    });
                }
            }
        })
    })

    $(".aimer_tag").on('click', '.deliker_tag', function () {
        const idTag = $(this).attr("idTag");
        $.ajax({
            type: "GET",
            url: "javascript/tags/deliker_tag.php",
            data: {
                idTag: idTag
            },
            dataType: "json",
            success: function (data) {
                if (data['connecte'] == false) {
                    pas_connecte();
                } else {
                    const boutons = document.getElementsByClassName('aimer_' + idTag);
                    Array.prototype.forEach.call(boutons, function (bouton) {
                            bouton.innerHTML = '<button type="button" class="like_tag liker_tag" idTag="'+ idTag + '"><img src="ressources/coeurs/coeur_vide.png" alt="logo like vide"></button type="button">';
                    });
                }
            }
        })
    })
});