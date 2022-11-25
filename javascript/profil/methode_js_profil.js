$(function () {
    const modal_pfp = document.getElementById("modal_pfp");
    const btn_pfp = document.getElementById("modif_pfp");

    btn_pfp.onclick = function () {
        modal_pfp.style.display = "flex";
    }

    const modal_abonne = document.getElementById("modal_abonne");
    
    window.onclick = function (event) {
        if (event.target == modal_pfp)
            modal_pfp.style.display = "none";
        if (event.target == modal_abonne)
            modal_abonne.style.display = "none";
    }

    $("#form_pfp").submit(
        function (event) {
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: "javascript/profil/changer_pfp.php",
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                dataType: "json",
                success: function (data) {
                    if (data != null) {
                        alert(data['erreur']);
                        modal_pfp.style.display = "none";
                    } else {
                        location.reload(true);
                    }
                }
            })
        });
});