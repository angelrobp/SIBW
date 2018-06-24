var click = false;
var par = true;
var img = ["../img/user.png","../img/user1.png","../img/user2.png"];
var contador_img = 1;

var asterisk_censure = "**";
var bad_words = ["(^|\\s)caca(\\s|$)", "(^|\\s)feo(\\s|$)", "(^|\\s)tonto(\\s|$)", "(^|\\s)idiota(\\s|$)", "(^|\\s)retrasado(\\s|$)", "(^|\\s)nazi(\\s|$)", "(^|\\s)marica(\\s|$)"];
var censure = false;

var date = new Date();
var month = date.getMonth()+1;
var minute = date.getMinutes();
if (minute < 10) {
    minute = "0"+minute;
}


date = date.getDate() + "/" + month + "/" + date.getFullYear() + " " + date.getHours() + ":" + minute;
function getDate() {
    return date;
}


function clearError () {
    var error = document.getElementById("error-message-comentario");
    error.style.display = "none";
    error.innerHTML = " ";
}

function reviser(submit) {
    censure = false;
    var x = document.getElementById("input-comentario");
    var str = x.value;
    var res = str.charAt(str.length-1);

    if (str.replace(/\s/g, "").length <= 0) {
        censure = true;
    } else if (res===" " || submit) {
        // RegEx sirve para definir una expresion regular
        // "i" es para ignorar un caso y "g" para un ambito global,
        // "|" para un operador OR
        var regex = new RegExp(bad_words.join("|"), "gi");
        x.value = str.replace(regex, function (match) {
            //reemplazamos cada letra por un *
            var censured = '';
            var i = 0;

            if (match.charAt(0) === ' ') {
                censured += ' ';
                i=1;
            }

            for (i; i < match.length-1; i++) {
                censured += '*';
            }

            if (match.charAt( match.length-1) === '' || match.charAt( match.length-1) === ' ') {
                censured += ' ';
            }
            else {
                censured += '*';
            }

            return censured;
        });

        if (x.value.indexOf(asterisk_censure) > -1) {
            censure = true;
        }
    }
    return censure;
}

/*
  Se sobreescribe el metodo submit para que no se recargue la pagina
*/

document.getElementById("form-messages").onsubmit = function () {

    if (reviser(true)) {
        var error = document.getElementById("error-message-comentario");
        error.style.display = "block";
        error.innerHTML = "*El comentario contiene contenido censurado*";
    }
    if (!censure) {

        return true;
    }
    else {
        return false;
    }


};