$(function () {
    $(document).click(function () {
        $(".options_collection").hide();
    })
    
    $(".options_bouton_Collection").click(
        function (event) {
            const element = "#options_collection" + $(this).attr("idCollection");
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
        function () {
            if (window.confirm("Êtes-vous sûr de vouloir supprimer ?")) {
                const id = $(this).attr("idPost");
                $.ajax({
                    type: "GET",
                    url: "javascript/collection/supprimer_post_collection.php",
                    data: { idCollection: id },
                    success: function () {
                        $("#" + id).remove();
                    }
                })
            }
        });
});