
function partilharTarefa() {
    var formData = new FormData(document.getElementById('partilharForm'));

    $.ajax({
        type: 'POST',
        url: '../secure/processar_partilha.php',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            console.log(response);

        },
        error: function (error) {
            // Lide com erros, se necessário
            console.error(error);
        }
    });
}
