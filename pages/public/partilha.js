// script.js

function partilharTarefa() {
    // Obtenha os dados do formulário
    var formData = new FormData(document.getElementById('partilharForm'));

    // Envie os dados via AJAX
    $.ajax({
        type: 'POST',
        url: '../secure/processar_partilha.php',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            // Lide com a resposta do servidor, se necessário
            console.log(response);

            // Atualize dinamicamente a página do outro usuário aqui
            // Isso pode envolver a manipulação do DOM para exibir a tarefa
        },
        error: function (error) {
            // Lide com erros, se necessário
            console.error(error);
        }
    });
}
