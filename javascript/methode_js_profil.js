$(function () {
    const modal = document.getElementById("myModal");
    const btn = document.getElementById("lien_pfp");

    btn.onclick = function () {
        modal.style.display = "flex";
    }

    window.onclick = function (event) {
        if (event.target == modal)
            modal.style.display = "none";
    }

    $("#form_pfp").submit(
        function (event) {
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: "javascript/changer_pfp.php",
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                dataType: "json",
                success: function (data) {
                    if (data != null) {
                        alert(data['erreur']);
                        modal.style.display = "none";
                    } else {
                        location.reload();
                    }
                }
            })
        })
});