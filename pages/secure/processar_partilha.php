<?php
require_once __DIR__ . '/../../infra/db/connection.php';

function createPartilhaTarefa($share)
{
    $sqlCreate = "INSERT INTO partilhaTarefa (tarefa_id, remetente_id, destinatario_id)
                  VALUES (
                      :tarefa_id,
                      :remetente_id,
                      (SELECT id FROM utilizadores WHERE email = :destinatario_email LIMIT 1)
                  )";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlCreate);

    return $PDOStatement->execute([
        ':tarefa_id' => $share['tarefa_id'],
        ':remetente_id' => $share['remetente_id'],
        ':destinatario_email' => $share['destinatario_email']
    ]);
}


function getPartilhaTarefaById($id)
{
  $PDOStatement = $GLOBALS['pdo']->prepare('SELECT * FROM partilhaTarefa WHERE id = ?;');
  $PDOStatement->bindValue(1, $id, PDO::PARAM_INT);
  $PDOStatement->execute();
  return $PDOStatement->fetch();
}

function getPartilhaTarefaByRemetenteId($remetenteId)
{
  $PDOStatement = $GLOBALS['pdo']->prepare('SELECT * FROM partilhaTarefa WHERE remetente_id = ?;');
  $PDOStatement->bindValue(1, $remetenteId, PDO::PARAM_INT);
  $PDOStatement->execute();
  $partilhaTarefaList = [];
  while ($partilhaTarefa = $PDOStatement->fetch()) {
    $partilhaTarefaList[] = $partilhaTarefa;
  }
  return $partilhaTarefaList;
}
$response = ['status' => 'success', 'message' => 'Partilha realizada com sucesso!'];
echo json_encode($response);
?>

