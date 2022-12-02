$(function () {
// GNU GPL Copyleft 2022 
    $(document).click(function () {
        $(".options_contenu").hide();
    })

    $(".options_bouton").click(
        function (event) {
            const element = "#options" + $(this).attr("idPost");
            if ($(element).is(":visible"))
                $(element).hide();
            else {
                $(".options_contenu").hide();
                $(element).show();
            }
            event.stopPropagation();
        }
    )

    $(".partager").click(
        function () {
            navigator.clipboard.writeText($(this).attr("lien"));
            alert("lien copié");
        })

    $(".supprimer").click(
        function () {
            if (window.confirm("Êtes-vous sûr de vouloir supprimer ?")) {
                const id = $(this).attr("idPost");
                $.ajax({
                    type: "GET",
                    url: "javascript/post/supprimer_post.php",
                    data: { idPost: id },
                    success: function () {
                        $("#" + id).remove();
                    }
                })
            }
        });

    $(".voter").click(
        function () {
            const id = $(this).attr("idPost");
            const vote = $(this).attr("vote");
            $.ajax({
                type: "GET",
                url: "javascript/post/voter.php",
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

});