var click = false;
var insertComment = false;
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

function hasClicked() {
    click = true;
}

function clearError () {
    var error = document.getElementById("error-message");
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

function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

document.getElementById("form-messages").onsubmit = function () {

    if (!validateEmail(document.forms["form-messages"]["input-email"].value)) {
        var error = document.getElementById("error-message-email");
        error.style.display = "block";
        error.innerHTML = "*El email no es correcto*";

    }
    if (reviser(true)) {
        var error = document.getElementById("error-message-comentario");
        error.style.display = "block";
        error.innerHTML = "*El comentario contiene contenido censurado*";
    }
    if (!censure) {
        /*      var div = document.createElement('div');
              var h = document.forms["form-messages"]["input-comentario"].value;
              var date = getDate();

              if (par) {
                  div.className = 'comentario-usuario par';
                  par=false;
              }
              else {
                  div.className = 'mentario-usuario';
                  par=true;
              }


              var html= '<div class="mensaje-user"><div class="user-img"><div class="nombre-usuario">';
              html += document.forms["form-messages"]["input-nombre"].value +'</div><img src="';
              html += img[contador_img]+'"></div><div class="texto-user"><p>';
              html += document.forms["form-messages"]["input-comentario"].value +'</p></div></div><span class="time-right">'+ getDate() +'</span>';
              div.innerHTML = html;

              var comentarios = document.getElementById('comentarios-anteriores');
              comentarios.insertBefore(div, comentarios.childNodes[0]);

        if (contador_img === 2) {
            contador_img = 0;
        }
        else {
            contador_img += 1;
        }

        document.forms["form-messages"]["input-comentario"].value = "";
        document.forms["form-messages"]["input-nombre"].value = "";
        document.forms["form-messages"]["input-email"].value = "";
        */
        //document.forms["form-messages"].submit();
        return true;
    }
    else {
        return false;
    }


};

document.getElementById( 'contenedor-comentarios' ).addEventListener( 'click', function() {

    var x = document.getElementById("comentarios");
    if (this.style.width == '4%' || this.style.width == '') {
        this.style.width = '24%';
        x.style.display = "initial";
        x = document.getElementsByClassName("imagen-comentarios")
        x[0].style.display = "none";
        x = document.getElementById("informacion");
        x.style.width = "59%";
    }

    if (click) {
        this.style.width = '4%';
        x = document.getElementById("comentarios");
        x.style.display = 'none';
        x = document.getElementById("informacion");
        x.style.width = '79%';
        x = document.getElementsByClassName("imagen-comentarios");
        x[0].style.display = 'initial';
        click=false;
    }

}, false );
