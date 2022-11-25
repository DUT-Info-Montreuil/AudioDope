$(function () {
    $(".div_bouton_abo").on( 'submit', '.form_desabonner',
        function (event) {
            event.preventDefault();
            const formData = new FormData(this);
            $.ajax({
                type: "POST",
                url: "javascript/abonnement/desabonner.php",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    if (data != null)
                        document.getElementById('div_bouton_abo' + formData.get('idUser')).innerHTML = data['data'];
                }
            })
        });

    $(".div_bouton_abo").on( 'submit', '.form_abonner',
        function (event) {
            event.preventDefault();
            const formData = new FormData(this);
            $.ajax({
                type: "POST",
                url: "javascript/abonnement/abonner.php",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    if (data != null)
                        document.getElementById('div_bouton_abo' + formData.get('idUser')).innerHTML = data['data'];
                }
            })
        })

});