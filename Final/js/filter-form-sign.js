
var par = true;
var img = ["../img/user.png","../img/user1.png","../img/user2.png"];
var contador_img = 1;

function clearError () {
    var error = document.getElementById("error-message");
    error.style.display = "none";
    error.innerHTML = " ";
}

/*
  Se sobreescribe el metodo submit para que no se recargue la pagina
*/

function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

document.getElementById("formSingUp").onsubmit = function () {

    if (!validateEmail(document.forms["formSingUp"]["input-email"].value)) {
        var error = document.getElementById("error-message-email");
        error.style.display = "block";
        error.innerHTML = "*El email no es correcto*";
        return false;
    }
    else {
        return true;
    }

};
/*
document.getElementById("formSingIn").onsubmit = function () {
    alert("Sing In");
        if (!validateEmail(document.forms["tabSingUp"]["input-email"].value)) {
            var error = document.getElementById("error-message-email");
            error.style.display = "block";
            error.innerHTML = "*El email no es correcto*";
            return false;
        }
        else {
            return true;
        }

};*/