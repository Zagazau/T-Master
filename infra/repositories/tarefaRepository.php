<?php
// tarefaRepository.php
require_once __DIR__ . '../../db/connection.php';

class TarefaRepository
{
    public function createTarefa($titulo, $descricao, $data_inicio, $data_fim, $prioridade, $estado, $favorita)
    {
        $sqlCreate = "INSERT INTO 
        tarefas (
            titulo, 
            descricao, 
            data_inicio, 
            data_fim, 
            prioridade, 
            estado, 
            favorita) 
        VALUES (
            :titulo, 
            :descricao, 
            :data_inicio, 
            :data_fim, 
            :prioridade, 
            :estado, 
            :favorita
        )";

        $PDOStatement = $GLOBALS['pdo']->prepare($sqlCreate);

        return $PDOStatement->execute([
            ':titulo' => $titulo,
            ':descricao' => $descricao,
            ':data_inicio' => $data_inicio,
            ':data_fim' => $data_fim,
            ':prioridade' => $prioridade,
            ':estado' => $estado,
            ':favorita' => $favorita,
        ]);
    }

    // Adicione aqui outros métodos necessários para manipulação de tarefas
    // Exemplo: métodos para obter tarefas, atualizar tarefas, excluir tarefas, etc.
}
?>
