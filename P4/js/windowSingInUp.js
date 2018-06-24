// Get the modal
var modalSign = document.getElementById('id01');

// Get the <span> element that closes the modal
var closeSign = document.getElementsByClassName("close-sign")[0];

// When the user clicks on <span> (x), close the modal
closeSign.onclick = function() {
    modalSign.style.display = "none";
}

function singInUp() {
    modalSign.style.display = "block";
    //document.getElementById("myDropdown").classList.toggle("show");
}