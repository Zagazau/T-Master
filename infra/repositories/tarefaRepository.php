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

    public function getTarefaById($id)
    {
        $sql = "SELECT * FROM tarefas WHERE id = :id";
        $statement = $GLOBALS['pdo']->prepare($sql);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllTarefas()
    {
        $sql = "SELECT * FROM tarefas";
        $statement = $GLOBALS['pdo']->query($sql);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateTarefa($id, $titulo, $descricao, $data_inicio, $data_fim, $prioridade, $estado, $favorita)
    {
        $sqlUpdate = "UPDATE tarefas SET 
            titulo = :titulo,
            descricao = :descricao,
            data_inicio = :data_inicio,
            data_fim = :data_fim,
            prioridade = :prioridade,
            estado = :estado,
            favorita = :favorita
            WHERE id = :id";

        $PDOStatement = $GLOBALS['pdo']->prepare($sqlUpdate);

        return $PDOStatement->execute([
            ':titulo' => $titulo,
            ':descricao' => $descricao,
            ':data_inicio' => $data_inicio,
            ':data_fim' => $data_fim,
            ':prioridade' => $prioridade,
            ':estado' => $estado,
            ':favorita' => $favorita,
            ':id' => $id,
        ]);
    }

    public function deleteTarefa($id)
    {
        $sqlDelete = "DELETE FROM tarefas WHERE id = :id";
        $PDOStatement = $GLOBALS['pdo']->prepare($sqlDelete);

        return $PDOStatement->execute([
            ':id' => $id,
        ]);
    }
}
?>