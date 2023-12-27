<?php
// processar_tarefa.php

// Certifique-se de incluir sua lógica de conexão com o banco de dados aqui
require_once __DIR__ . '/../../infra/middlewares/middleware-not-authenticated.php';
require_once __DIR__ . '/../../infra/repositories/tarefaRepository.php'; // Adicione o caminho correto para o seu repositório

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtém os dados do formulário
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $data_inicio = $_POST['data_inicio'];
    $data_fim = $_POST['data_fim'];
    $prioridade = $_POST['prioridade'];
    $estado = $_POST['estado'];
    $favorita = isset($_POST['favorita']) ? 1 : 0;

    // Pode adicionar a lógica para validar os dados conforme necessário

    // Insira os dados na tabela tarefas
    $tarefaRepository = new TarefaRepository(); // Substitua pelo nome correto da sua classe de repositório
    $tarefaRepository->createTarefa($titulo, $descricao, $data_inicio, $data_fim, $prioridade, $estado, $favorita);

    // Redirecione para a página principal após a inserção
    header('Location: /tmaster/pages/secure/main.php');
    exit();
} else {
    // Se o formulário não foi enviado, redirecione para a página principal
    header('Location: /tmaster/pages/secure/main.php');
    exit();
}
?>