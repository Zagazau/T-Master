<?php
require_once __DIR__ . '/../../infra/middlewares/middleware-not-authenticated.php';
require_once __DIR__ . '/../../infra/repositories/tarefaRepository.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tarefa_id = $_POST['tarefa_id'];

    $tarefaRepository = new TarefaRepository();
    $tarefaRepository->deleteTarefa($tarefa_id);

    header('Location: /tmaster/pages/public/main.php');
    exit();
} else {
    header('Location: /tmaster/pages/public/main.php');
    exit();
}
?>
