$(function () {
    $(".liker_tag").click(
        function () {
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
                        const bouton = document.querySelector('[idTag="'+idTag+'"]');
                        bouton.classList.remove('liker_tag');
                        boutonclassList.remove('deliker_tag');
                        bouton.innerHTML = "<img src=\"ressources/coeurs/coeur_plein.png\" alt=\"logo like plein\">";
                    }
                }
            })
        })

});