function ajaxCall(cadena, permiso)
{
    if (cadena.length==0) {
        document.getElementById("livesearch").innerHTML="";
        document.getElementById("livesearch").style.border="0px";
        return;
    }

    $.ajax({
        url: 'search.php',
        type: "GET",
        data: {str: cadena, permiso: permiso},
        success: function(rows) {
            document.getElementById("livesearch").innerHTML=rows;
            document.getElementById("livesearch").style.border="1px solid #A5ACB2";
        },
        error: function (err) {
            console.log("AJAX error in request: " + JSON.stringify(err, null, 2));
        }
    });
}