$(function () {
    /*AudioDope - Version 1.0 - 2022
GNU GPL CopyLeft 2022-2032
Hugo COHEN - Ayoub BOUAZIZ - Steven YANG*/
    $(document).click(function () {
        $(".Collection_options_contenu").hide();
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
        function (event) {
            event.preventDefault();
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


      
    });
   