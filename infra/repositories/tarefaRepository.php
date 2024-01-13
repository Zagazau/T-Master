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
            favorita,
            utilizador_id) 
        VALUES (
            :titulo, 
            :descricao, 
            :data_inicio, 
            :data_fim, 
            :prioridade, 
            :estado, 
            :favorita,
            :utilizador_id
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
            ':utilizador_id' => $_SESSION['id']
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
        $utilizador_id = isset($_SESSION['id']) ? $_SESSION['id'] : null;

        $sql = "SELECT * FROM tarefas where utilizador_id = :utilizador_id";
        $statement = $GLOBALS['pdo']->prepare($sql);
        $statement->bindParam(':utilizador_id', $utilizador_id, PDO::PARAM_INT);

        $statement->execute();
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

    public function getTarefasCalendario($userId)
    {
        $sql = "SELECT t.titulo, t.data_inicio
                FROM tarefas t
                WHERE t.utilizador_id = :user_id AND t.data_inicio IS NOT NULL";

        $PDOStatement = $GLOBALS['pdo']->prepare($sql);
        $PDOStatement->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $PDOStatement->execute();

        $events = [];

        while ($tarefa = $PDOStatement->fetch()) {
            $start = date('Y-m-d', strtotime($tarefa['data_inicio']));

            $events[] = [
                'title' => $tarefa['titulo'],
                'start' => $start,
            ];
        }

        return $events;
    }

}
?>