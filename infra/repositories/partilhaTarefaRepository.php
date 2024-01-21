<?php
require_once __DIR__ . '../../db/connection.php';

class PartilhaTarefaRepository
{
    public function partilharTarefa($remetenteId, $destinatarioId, $tarefaId)
{
    try {
        $sql = "INSERT INTO partilhaTarefa (remetente_id, destinatario_id, tarefa_id) VALUES (:remetente_id, :destinatario_id, :tarefa_id)";
        $PDOStatement = $GLOBALS['pdo']->prepare($sql);
        $PDOStatement->bindParam(':remetente_id', $remetenteId, PDO::PARAM_INT);
        $PDOStatement->bindParam(':destinatario_id', $destinatarioId, PDO::PARAM_INT);
        $PDOStatement->bindParam(':tarefa_id', $tarefaId, PDO::PARAM_INT);
        
        return $PDOStatement->execute();
    } catch (PDOException $e) {
        return false;
    }
}


    public function getTarefasPartilhadas($userId)
    {
        $sql = "SELECT pt.id, t.titulo, t.descricao, t.data_inicio, t.data_fim, t.prioridade, t.estado, t.favorita, u.nome as remetente_nome
                FROM partilhaTarefa pt
                JOIN tarefas t ON pt.tarefa_id = t.id
                JOIN utilizadores u ON pt.remetente_id = u.id
                WHERE pt.destinatario_id = :user_id";

        $PDOStatement = $GLOBALS['pdo']->prepare($sql);
        $PDOStatement->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $PDOStatement->execute();

        return $PDOStatement->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>