$(function () {

    $(document).click(function () {
        $(".options_contenu").hide();
    });

    $(".options_bouton").click(
        function (event) {
            var element = "#options" + $(this).attr("idPost");
            if ($(element).is(":visible"))
                $(element).hide();
            else {
                $(".options_contenu").hide();
                $(element).show();
            }
            event.stopPropagation();
        }
    );

    $(".partager").click(
        function () {
            navigator.clipboard.writeText($(this).attr("lien"));
            alert("lien copié");
        });

    $(".supprimer").click(
        function () {
            if (window.confirm("Êtes-vous sûr de vouloir supprimer ?")) {
                var id = $(this).attr("idPost");
                $.ajax({
                    type: "GET",
                    url: "javascript/supprimer_post.php",
                    data: { idPost: id },
                    success: function () {
                        $("#" + id).remove();
                    }
                })
            }
        });

    $(".voter").click(
        function () {
            var id = $(this).attr("idPost");
            var vote = $(this).attr("vote");
            $.ajax({
                type: "GET",
                url: "javascript/voter.php",
                data: {
                    idPost: id,
                    vote: vote,
                },
                dataType: "json",
                success: function (data) {
                    if (data['connecte'] == false) {
                        pas_connecte();
                    } else {
                        if (data['vote'] == 0) {
                            $("#imgUpVote" + id).attr('src', 'ressources/fleches/fleche_haut_vide.png')
                            $("#imgDownVote" + id).attr('src', 'ressources/fleches/fleche_bas_vide.png');
                        } else if (data['vote'] == 1) {
                            $("#imgUpVote" + id).attr('src', 'ressources/fleches/fleche_haut_plein.png')
                            $("#imgDownVote" + id).attr('src', 'ressources/fleches/fleche_bas_vide.png');
                        } else {
                            $("#imgUpVote" + id).attr('src', 'ressources/fleches/fleche_haut_vide.png')
                            $("#imgDownVote" + id).attr('src', 'ressources/fleches/fleche_bas_plein.png');
                        }
                        $('#nb_vote' + id).text(data['nb_vote']);
                    }
                }
            })
        })

    $(window).scroll(function () {

        var header = document.getElementById("navbar");
        var main = document.getElementById("main");
        var fixe = header.offsetTop;

        if (window.pageYOffset > fixe) {
            main.classList.add("decalage");
            header.classList.add("fixe");
        } else {
            main.classList.remove("decalage");
            header.classList.remove("fixe");
        }
    })
});

function pas_connecte() {
    if (window.confirm("Connectez ou inscrivez-vous pour pouvoir voter. Souhaitez-vous connecter ?")) {
        window.open("index.php?module=connexion", "_self");
    }
}