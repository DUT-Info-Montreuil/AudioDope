$(function () {
    // GNU GPL Copyleft 2022 
    const modal_pfp = document.getElementById("modal_pfp");
    const btn_pfp = document.getElementById("modif_pfp");

    if (btn_pfp != null) {
        btn_pfp.onclick = function () {
            modal_pfp.style.display = "flex";
        }
    }

    const modal_abo = document.getElementById("modal_abo");

    window.onclick = function (event) {
        if (event.target == modal_pfp)
            modal_pfp.style.display = "none";
        if (event.target == modal_abo)
            modal_abo.style.display = "none";
    }

    $("#form_pfp").submit(
        function (event) {
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: "javascript/profil/changer_pfp.php",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
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