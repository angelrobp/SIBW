var clickPanelControl = false;

function hasClickedPanelControl() {
    clickPanelControl = true;
}

document.getElementById( 'contenedor-controlpanel' ).addEventListener( 'click', function() {

    var x = document.getElementById("controlpanel");
    if (this.style.width == '4%' || this.style.width == '') {
        this.style.width = '100%';
        x.style.display = "initial";
        x = document.getElementsByClassName("imagen-controlpanel")
        x[0].style.display = "none";
        document.getElementById("defaultOpenControlPanel").click();
    }

    if (clickPanelControl) {
        this.style.width = '4%';
        x = document.getElementById("controlpanel");
        x.style.display = 'none';
        x = document.getElementsByClassName("imagen-controlpanel");
        x[0].style.display = 'initial';
        clickPanelControl=false;
    }

}, false );

function openTabControlPanel(evt, tabName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
}

//Tab Añadir/Eliminar Permisos

function setOpcionesPermisos(value) {
   value = value.split("|");

   var x = document.getElementById("selectPermiso");

   for (var i=0; i < x.children.length ; i++) {
       if (x.children[i].value == value[0]) {
           x.children[i].selected = "true";
       }
   }

    x = document.getElementById("usuarioPermiso");
    x.value = value[1];
}


//Tab Editar/Eliminar Obra

function setOpcionesObras(id) {

    var value = document.getElementById(id).value.split("|");

    document.getElementById("idObra").value=value[0];
    document.getElementById("input-imagen").value=value[1];
    document.getElementById("input-nombre").value=value[2];
    document.getElementById("input-historia1").value=value[3];
    document.getElementById("input-historia2").value=value[4];
    document.getElementById("input-historia3").value=value[5];
    document.getElementById("input-estadio1").value=value[6];
    document.getElementById("input-estadio2").value=value[7];
    document.getElementById("input-estadio3").value=value[8];
}

//Tab Editar/Eliminar Comentario

function setOpcionesComentarios(id) {

    var value = document.getElementById(id).value.split("|");

    document.getElementById("idComentario").value=value[0];
    document.getElementById("input-comentario").value=value[1];
}