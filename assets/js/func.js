
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

function updateClock() {
    var currentTime = new Date();
    var hours = currentTime.getHours();
    var minutes = currentTime.getMinutes();
    var seconds = currentTime.getSeconds();

    var formattedTime = hours + ":" + (minutes < 10 ? "0" : "") + minutes + ":" + (seconds < 10 ? "0" : "") + seconds;

    document.getElementById('current-time').innerText = formattedTime;
}

setInterval(updateClock, 1000);
updateClock();
