<?php
// Inclua o arquivo que contém a classe TarefaRepository
require_once __DIR__ . '/../../infra/repositories/tarefaRepository.php';

// Crie uma instância do TarefaRepository
$tarefaRepository = new TarefaRepository();

// Obtenha o ID da tarefa da consulta GET
$tarefa_id = isset($_GET['tarefa_id']) ? $_GET['tarefa_id'] : null;

// Verifique se o ID é válido
if (!$tarefa_id) {
    // Redirecione de volta à página principal ou mostre uma mensagem de erro
    header('Location: /main.php');
    exit();
}

// Obtenha os detalhes da tarefa com base no ID
$tarefa_existente = $tarefaRepository->getTarefaById($tarefa_id);

// Verifique se a tarefa existe
if (!$tarefa_existente) {
    // Redirecione de volta à página principal ou mostre uma mensagem de erro
    header('Location: /main.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tarefa</title>
    <!-- Adicione seus cabeçalhos comuns aqui -->
    <!-- Certifique-se de incluir Bootstrap se necessário -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Adicione outros estilos necessários -->
</head>

<body>

    <div class="container mt-5">
        <!-- Formulário de Edição -->
        <form action="/tmaster/pages/public/processar_edicao.php" method="post">
            <input type="hidden" name="tarefa_id" value="<?= $tarefa_existente['id'] ?>">
            <div class="form-group">
                <label for="novo_titulo">Novo Título:</label>
                <input type="text" id="novo_titulo" name="novo_titulo" value="<?= $tarefa_existente['titulo'] ?>"
                    required>

            </div>
            <div class="form-group">
                <label for="nova_descricao">Nova Descrição:</label>
                <textarea id="nova_descricao" class="form-control" name="nova_descricao"
                    rows="4"><?= $tarefa_existente['descricao'] ?></textarea>
            </div>
            <!-- Adicione outros campos conforme necessário -->
            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        </form>
    </div>

    <!-- Certifique-se de incluir Bootstrap JS e outros scripts necessários -->

</body>

</html>