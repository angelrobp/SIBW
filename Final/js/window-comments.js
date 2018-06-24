var clickComments = false;

function hasClicked() {
    clickComments = true;
}

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

    if (clickComments) {
        this.style.width = '4%';
        x = document.getElementById("comentarios");
        x.style.display = 'none';
        x = document.getElementById("informacion");
        x.style.width = '79%';
        x = document.getElementsByClassName("imagen-comentarios");
        x[0].style.display = 'initial';
        clickComments=false;
    }

}, false );
