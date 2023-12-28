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

            <div class="form-group">
                <label for="nova_data_inicio">Nova Data de Início:</label>
                <input type="date" id="nova_data_inicio" name="nova_data_inicio"
                    value="<?= $tarefa_existente['data_inicio'] ?>">
            </div>

            <div class="form-group">
                <label for="nova_data_fim">Nova Data de Fim:</label>
                <input type="date" id="nova_data_fim" name="nova_data_fim" value="<?= $tarefa_existente['data_fim'] ?>">
            </div>

            <div class="form-group">
                <label for="nova_prioridade">Nova Prioridade (de 1 a 5):</label>
                <select id="nova_prioridade" name="nova_prioridade" class="form-select">
                    <option value="1" <?= $tarefa_existente['prioridade'] == 1 ? 'selected' : '' ?>>1</option>
                    <option value="2" <?= $tarefa_existente['prioridade'] == 2 ? 'selected' : '' ?>>2</option>
                    <option value="3" <?= $tarefa_existente['prioridade'] == 3 ? 'selected' : '' ?>>3</option>
                    <option value="4" <?= $tarefa_existente['prioridade'] == 4 ? 'selected' : '' ?>>4</option>
                    <option value="5" <?= $tarefa_existente['prioridade'] == 5 ? 'selected' : '' ?>>5</option>
                </select>
            </div>

            <div class="form-group">
                <label for="novo_estado">Novo Estado:</label>
                <select id="novo_estado" name="novo_estado" class="form-select">
                    <option value="Por fazer" <?= $tarefa_existente['estado'] == 'Por fazer' ? 'selected' : '' ?>>Por
                        fazer</option>
                    <option value="A ser feita" <?= $tarefa_existente['estado'] == 'A ser feita' ? 'selected' : '' ?>>A
                        ser feita</option>
                    <option value="Terminada" <?= $tarefa_existente['estado'] == 'Terminada' ? 'selected' : '' ?>>
                        Terminada</option>
                </select>
            </div>

            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="nova_favorita" name="nova_favorita"
                    <?= $tarefa_existente['favorita'] ? 'checked' : '' ?>>
                <label class="form-check-label" for="nova_favorita">Nova Favorita</label>
            </div>

            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        </form>
    </div>

    <!-- Certifique-se de incluir Bootstrap JS e outros scripts necessários -->

</body>

</html>