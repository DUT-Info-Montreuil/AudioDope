$(function () {
    /*AudioDope - Version 1.0 - 2022
GNU GPL CopyLeft 2022-2032
Hugo COHEN - Ayoub BOUAZIZ - Steven YANG*/
    $(document).click(function () {
        $(".options_contenu_collection").hide();
    })
    
    $(".options_bouton_Collection").click(
        function (event) {
            const element = "#options_contenu_collection" + $(this).attr("idCollection");
            if ($(element).is(":visible"))
                $(element).hide();
            else {
                $(".options_contenu_collection").hide();
                $(element).show();
            }
            event.stopPropagation();
        }
    )

    $(".supprimer_post_collection").click(
        function (event) {
            event.preventDefault();
            if (window.confirm("Êtes-vous sûr de vouloir supprimer ?")) {
                const idPost = $(this).attr("idPost");
                const idCollection = $(this).attr("idCollection");
                $.ajax({
                    type: "GET",
                    url: "javascript/collection/supprimer_post_collection.php",
                    data: { idCollection: idCollection,
                        idPost: idPost
                    },
                    success: function () {
                        $("#div_post_collection" + idPost).remove();
                    }
                })
            }
        });
});