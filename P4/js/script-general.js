
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (typeof modal !== 'undefined') {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    if (typeof modalSign !== 'undefined') {
        if (event.target == modalSign) {
            modalSign.style.display = "none";
        }
    }

}