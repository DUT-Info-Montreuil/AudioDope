$(function() {
    window.onscroll = function () {
        if (window.scrollY + window.innerHeight >= document.documentElement.scrollHeight) {
            $.ajax({
                type: "GET",
                url: "javascript/scroll.php",
                data: {
                    nb_posts: $('#posts').attr('nb_posts'),
                    module: get_module(),
                    action: get_action(),
                },
                dataType: "json",
                success: function (data) {
                    if (data['posts'] != 'undefined') {
                        const nb_posts = parseInt($('#posts').attr('nb_posts')) + 20;
                        $('#posts').attr('nb_posts', nb_posts);
                        document.getElementById("posts").innerHTML += data['posts'];
                    } else {
                        document.getElementById("posts").innerHTML += data['posts'];
                    }
                }
            })
        }
    }
})


function pas_connecte() {
    if (window.confirm("Connectez ou inscrivez-vous pour pouvoir voter. Souhaitez-vous connecter ?")) {
        window.open("index.php?module=connexion", "_self");
    }
}

function get_module() {
    const url = window.location.href;
    const index_module = url.indexOf('module') + 7;
    const index_et = url.indexOf('&', index_module);
    let module = " ";
    if (index_module != -1) {
        if (index_et == -1) {
            module = url.substring(index_module);
        } else {
            module = url.substring(index_module, index_et);
        }
    }
    return module;
}

function get_action() {
    const url = window.location.href;
    const index_action = url.indexOf('action') + 7;
    const index_et = url.indexOf('&', index_action);
    let action = " ";
    if (index_action != -1) {
        if (index_et == -1) {
            action = url.substring(index_action);
        } else {
            action = url.substring(index_action, index_et);
        }
    }
    return action;
}