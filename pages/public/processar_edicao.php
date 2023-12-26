<?php
require_once __DIR__ . '/../../infra/middlewares/middleware-not-authenticated.php';
require_once __DIR__ . '/../../infra/repositories/tarefaRepository.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tarefa_id = $_POST['tarefa_id'];
    $novo_titulo = $_POST['novo_titulo'];
    $nova_descricao = $_POST['nova_descricao'];

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
        $tarefa_existente['data_inicio'],
        $tarefa_existente['data_fim'],
        $tarefa_existente['prioridade'],
        $tarefa_existente['estado'],
        $tarefa_existente['favorita']
    );

    header('Location: /tmaster/pages/public/main.php');
    exit();
} else {
    header('Location: /tmaster/pages/public/main.php');
    exit();
}
?>
