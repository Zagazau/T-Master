<?php
require_once __DIR__ . '/../../infra/middlewares/middleware-not-authenticated.php';
require_once __DIR__ . '/../../infra/repositories/tarefaRepository.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tarefa_id = $_POST['tarefa_id'];
    $novo_titulo = $_POST['novo_titulo'];
    $nova_descricao = $_POST['nova_descricao'];
    $nova_data_inicio = $_POST['nova_data_inicio'];
    $nova_data_fim = $_POST['nova_data_fim'];
    $nova_prioridade = $_POST['nova_prioridade'];
    $novo_estado = $_POST['novo_estado'];
    $nova_favorita = isset($_POST['nova_favorita']) ? 1 : 0;

    $tarefaRepository = new TarefaRepository();
    
    // Obtém os dados existentes da tarefa
    $tarefa_existente = $tarefaRepository->getTarefaById($tarefa_id);

    // Atualiza apenas os campos fornecidos, mantendo os dados existentes para os não fornecidos
    $titulo = $novo_titulo ?? $tarefa_existente['titulo'];
    $descricao = $nova_descricao ?? $tarefa_existente['descricao'];

    // Atualiza a tarefa
    $tarefaRepository->updateTarefa(
        $tarefa_id,
        $titulo,
        $descricao,
        $nova_data_inicio,
        $nova_data_fim,
        $nova_prioridade,
        $novo_estado,
        $nova_favorita
    );

    header("Location: /tmaster/pages/secure/main.php");
    exit();
} else {
    header('Location: /tmaster/pages/secure/main.php');
    exit();
}
?>