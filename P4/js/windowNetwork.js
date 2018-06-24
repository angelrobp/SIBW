// Get the modal
var modal = document.getElementById('myModal');


// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

var button = document.getElementById('input-accept');

var type_network = document.getElementById('type_network');

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

button.onclick = function() {
    modal.style.display = "none";
}

function share(network){
    type_network.innerText=network;
    modal.style.display = "block";
}