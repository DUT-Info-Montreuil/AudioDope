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
            const file = document.getElementById('id_file_pfp');
            alert(file);
            $.ajax({
                type: "GET",
                url: "javascript/changer_pfp.php",
                data: {
                    id: 5,
                    file_pfp: file
                },
                dataType: "json",
                success: function (data) {
                    alert(data['erreur']);
                    modal.style.display = "none";
                }
            })
            event.preventDefault();
        })
});