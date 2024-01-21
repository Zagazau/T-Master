<?php
require_once __DIR__ . '../../db/connection.php';

class PartilhaTarefaRepository
{
    public function partilharTarefa($remetenteId, $destinatarioId, $tarefaId)
    {
        $sql = "INSERT INTO partilhaTarefa (remetente_id, destinatario_id, tarefa_id) VALUES (:remetente_id, :destinatario_id, :tarefa_id)";

        $PDOStatement = $GLOBALS['pdo']->prepare($sql);

        return $PDOStatement->execute([
            ':remetente_id' => $remetenteId,
            ':destinatario_id' => $destinatarioId,
            ':tarefa_id' => $tarefaId,
        ]);
    }

    public function getTarefasPartilhadas($userId)
    {
        $sql = "SELECT pt.id, t.titulo, t.descricao, t.data_inicio, t.data_fim, t.prioridade, t.estado, t.favorita
                FROM partilhaTarefa pt
                JOIN tarefas t ON pt.tarefa_id = t.id
                WHERE pt.destinatario_id = :user_id";

        $PDOStatement = $GLOBALS['pdo']->prepare($sql);
        $PDOStatement->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $PDOStatement->execute();

        return $PDOStatement->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>

