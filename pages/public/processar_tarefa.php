<?php

require_once __DIR__ . '/../../infra/middlewares/middleware-not-authenticated.php';
require_once __DIR__ . '/../../infra/repositories/tarefaRepository.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $data_inicio = $_POST['data_inicio'];
    $data_fim = $_POST['data_fim'];
    $prioridade = $_POST['prioridade'];
    $estado = $_POST['estado'];
    $favorita = isset($_POST['favorita']) ? 1 : 0;

    $tarefaRepository = new TarefaRepository();
    $tarefaRepository->createTarefa($titulo, $descricao, $data_inicio, $data_fim, $prioridade, $estado, $favorita);


    header('Location: /tmaster/pages/secure/main.php');
    exit();
} else {
    header('Location: /tmaster/pages/secure/main.php');
    exit();
}
?>