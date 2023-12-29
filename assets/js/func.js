
function voltarParaPaginaAnterior() {
    window.history.back();
}


function displayImage(input) {
    var file = input.files[0];

    if (file) {
        var reader = new FileReader();

        reader.onload = function (e) {
            document.getElementById('perfilImage').src = e.target.result;
        };

        reader.readAsDataURL(file);
    }
}