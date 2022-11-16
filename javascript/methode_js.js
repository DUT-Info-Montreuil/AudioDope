$(function () {
    $(document).click(function () {
        $(".options_contenu").hide();
    }),

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
        ),

        $(".partager").click(
            function () {
                navigator.clipboard.writeText($(this).attr("lien"));
                alert("lien copié");
            }),

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
            }),

        $(".voter").click(
            function () {
                var id = parseInt($(this).attr("idPost"));
                var vote = parseInt($(this).attr("vote"));
                var idUser = parseInt($(this).attr("idUser"));
                if (idUSer != 6) {
                    pas_connecte();
                }else {
                    alert(idUser);
                    $.ajax({
                        type: "GET",
                        url: "javascript/voter.php",
                        data: {
                            idPost: id,
                            vote: vote,
                            idUser: idUser
                        },
                        dataType: "json",
                        success: function (data) {
                            alert(data['vote']);
                            if (data['vote'] == 0) {
                                $("#imgUpVote" + id) = "ressources/fleches/fleche_haut_vide.png";
                                $("#imgDownVote" + id) = "ressources/fleches/fleche_bas_vide.png";
                            } else if (data['vote'] == 1) {
                                $("#imgUpVote" + id) = "ressources/fleches/fleche_haut_plein.png";
                                $("#imgDownVote" + id) = "ressources/fleches/fleche_bas_vide.png";
                            } else {
                                $("#imgUpVote" + id) = "ressources/fleches/fleche_haut_vide.png";
                                $("#imgDownVote" + id) = "ressources/fleches/fleche_bas_plein.png";
                            }
                            $('#nb_vote' + id).text(data['nb_votes']);
                        }
                    })
                } 
            })
});

function pas_connecte() {
    if (window.confirm("Connectez ou inscrivez-vous pour pouvoir voter. Souhaitez-vous connecter ?")) {
        window.open("index.php?module=connexion", "_self");
    }
}