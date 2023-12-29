<?php
require_once __DIR__ . '/../../infra/middlewares/middleware-not-authenticated.php';
require_once __DIR__ . '/../../infra/repositories/tarefaRepository.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifique se o parâmetro 'tarefa_id' está definido no POST
    if (isset($_POST['tarefa_id'])) {
        $tarefa_id = $_POST['tarefa_id'];

        $tarefaRepository = new TarefaRepository();

        // Lógica de exclusão da tarefa aqui
        $tarefaRepository->deleteTarefa($tarefa_id);

        // Redirecione de volta à página principal
        header('Location: /tmaster/pages/secure/main.php');
        exit();
    } else {
        // Caso 'tarefa_id' não esteja definido no POST, redirecione de volta à página principal
        header('Location: /tmaster/pages/secure/main.php');
        exit();
    }
} else {
    // Se a solicitação não for POST, redirecione de volta à página principal
    header('Location: /tmaster/pages/secure/main.php');
    exit();
}
?>