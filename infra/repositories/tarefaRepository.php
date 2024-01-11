<?php
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
        try {
            $sqlDelete = "DELETE FROM tarefas WHERE id = :id";
            $PDOStatement = $GLOBALS['pdo']->prepare($sqlDelete);

            if ($PDOStatement === false) {
                return false;
            }

            $result = $PDOStatement->execute([
                ':id' => $id,
            ]);

            if ($result === false) {

                return false;
            }
            return true;
        } catch (PDOException $e) {

            return false;
        }
    }

    public function filtrarTarefas($estado, $prioridade)
    {

        $sql = "SELECT * FROM tarefas";
        $statement = $GLOBALS['pdo']->prepare($sql);

        if ($estado == "" && $prioridade != "") {

            $sql = "SELECT * FROM tarefas WHERE prioridade = :prioridade";
            $statement = $GLOBALS['pdo']->prepare($sql);
            $statement->bindParam(':prioridade', $prioridade, PDO::PARAM_INT);

        } else if ($prioridade == "" && $estado != "") {

            $sql = "SELECT * FROM tarefas WHERE estado = :estado";
            $statement = $GLOBALS['pdo']->prepare($sql);
            $statement->bindParam(':estado', $estado, PDO::PARAM_STR);

        } else if ($estado != "" && $prioridade != "") {

            $sql = "SELECT * FROM tarefas WHERE estado = :estado AND prioridade = :prioridade";
            $statement = $GLOBALS['pdo']->prepare($sql);
            $statement->bindParam(':estado', $estado, PDO::PARAM_STR);
            $statement->bindParam(':prioridade', $prioridade, PDO::PARAM_INT);

        }

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function pesquisarTarefa($titulo)
    {
        $sql = "SELECT * FROM tarefas WHERE titulo LIKE :titulo";
        $statement = $GLOBALS['pdo']->prepare($sql);
        $statement->bindValue(':titulo', '%' . $titulo . '%', PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>