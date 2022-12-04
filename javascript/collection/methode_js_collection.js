$(function () {
    $(document).click(function () {
        $(".Collection_options").hide();
    })
    
    $(".Collection_options_bouton").click(
        function (event) {
            const element = "#Collection_options" + $(this).attr("idCollection");
            if ($(element).is(":visible"))
                $(element).hide();
            else {
                $(".Collection_options_contenu").hide();
                $(element).show();
            }
            event.stopPropagation();
        }
    )
    $(".supprimer_collection").click(
        function () {
            if (window.confirm("Êtes-vous sûr de vouloir supprimer ?")) {
                const id = $(this).attr("idCollection");
                $.ajax({
                    type: "GET",
                    url: "javascript/collection/supprimer_collection.php",
                    data: { idCollection: id },
                    success: function () {
                        $("#" + id).remove();
                    }
                })
            }
        });

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
   