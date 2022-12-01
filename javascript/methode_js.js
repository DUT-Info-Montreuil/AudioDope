$(function() {
    window.onscroll = function () {
        if (window.scrollY + window.innerHeight >= document.documentElement.scrollHeight) {
            $.ajax({
                type: "GET",
                url: "javascript/scroll.php" + get_arguments(),
                data: {
                    nb_posts: $('#posts').attr('nb_posts'),
                },
                dataType: "json",
                success: function (data) {
                    if (data['posts'] != undefined) {
                        const nb_posts = parseInt($('#posts').attr('nb_posts')) + 20;
                        $('#posts').attr('nb_posts', nb_posts);
                        document.getElementById("posts").innerHTML += data['posts'];
                    } else {
                        document.getElementById("gif_loading").innerHTML = "";
                    }
                }
            })
        }
    }
})


function pas_connecte() {
    if (window.confirm("Connectez ou inscrivez-vous pour pouvoir accéder à cette fonctionnalité. Souhaitez-vous connecter ?")) {
        window.open("index.php?module=connexion", "_self");
    }
}

function get_arguments() {
    const url = window.location.href;
    const index_module = url.indexOf('?');
    return url.substring(index_module);
}