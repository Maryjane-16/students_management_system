/**
 * 
 * @param {*} event Checking the uploaded image doesn't exceed the dimension limit
 */

function checkImageResolution(event) {
    var file = event.target.files[0];
    var img = new Image();

    img.onload = function() {
    var maxWidth = 350; // Maximum width allowed
    var maxHeight = 200; // Maximum height allowed

    if (img.width > maxWidth && img.height > maxHeight) {
        document.getElementById('error-message').textContent = "Sorry! Image resolution must be at least 350 x 200.";
        event.target.value = ""; // Reset the file input
    } else {
        document.getElementById('error-message').textContent = "";
    }
    };

    img.src = URL.createObjectURL(file);
}