<?php
require_once __DIR__ . '/../../infra/middlewares/middleware-user.php';
require_once __DIR__ . '/../../infra/db/connection.php';
require_once __DIR__ . '/../../infra/repositories/tarefaRepository.php';
require_once __DIR__ . '/../../infra/repositories/partilhaTarefaRepository.php';

$tarefaRepository = new TarefaRepository();
$partilhaTarefaRepository = new PartilhaTarefaRepository();

$tarefasPartilhadas = $partilhaTarefaRepository->getTarefasPartilhadas($_SESSION['id']);

$tarefas = $tarefaRepository->getAllTarefas();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['partilhar_tarefa'])) {
    $remetenteId = $_SESSION['id'];
    $tarefaId = $_POST['tarefa_id'];
    $destinatarioEmail = $_POST['destinatario_email'];

    $tarefa = $tarefaRepository->getTarefaById($tarefaId);

    if ($tarefa && $tarefa['utilizador_id'] == $remetenteId) {

        $destinatarioId = $tarefaRepository->getUserIdByEmail($destinatarioEmail);

        if ($destinatarioId) {
            $partilhaTarefaRepository->partilharTarefa($remetenteId, $destinatarioId, $tarefaId);

            echo "Tarefa partilhada com sucesso!";
        } else {
            echo "Destinatário não encontrado. Certifique-se de inserir um email válido.";
        }
    } else {
        echo "A tarefa selecionada não lhe pertence.";
    }
}
?>


<div class="container">
    <h2>Partilhar Tarefa</h2>
    <form action="#" method="post">
        <div class="form-group">
            <label for="tarefa_id">Selecione a Tarefa:</label>
            <select class="form-control" id="tarefa_id" name="tarefa_id" required>
                <?php foreach ($tarefas as $tarefa): ?>
                <option value="<?= $tarefa['id'] ?>"><?= $tarefa['titulo'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="destinatario_email">Email do Destinatário:</label>
            <input type="email" class="form-control" id="destinatario_email" name="destinatario_email" required>
        </div>
        <button type="submit" class="btn btn-primary" name="partilhar_tarefa">Partilhar Tarefa</button>
    </form>
</div>
<div class="table-responsive">
    <table class="table table-striped table-bordered mt-4">
        <thead class="thead-dark">
            <tr>
                <th>Título</th>
                <th>Descrição</th>
                <th>Data de Início</th>
                <th>Data de Fim</th>
                <th>Prioridade</th>
                <th>Estado</th>
                <th>Favorita</th>
                <th>Remetente</th>
                <!-- Remova a coluna de "Ações" se não for necessária -->
            </tr>
        </thead>
        <tbody>
            <?php
            if ($tarefasPartilhadas) {
                foreach ($tarefasPartilhadas as $tarefaPartilhada) {
                    ?>
            <tr>
                <td><?= $tarefaPartilhada['titulo'] ?></td>
                <td><?= $tarefaPartilhada['descricao'] ?></td>
                <td><?= $tarefaPartilhada['data_inicio'] ?></td>
                <td><?= $tarefaPartilhada['data_fim'] ?></td>
                <td><?= $tarefaPartilhada['prioridade'] ?></td>
                <td><?= $tarefaPartilhada['estado'] ?></td>
                <td><?= $tarefaPartilhada['favorita'] ? 'Sim' : 'Não' ?></td>
                <td><?= isset($tarefaPartilhada['remetente_nome']) ? $tarefaPartilhada['remetente_nome'] : 'N/A' ?></td>
            </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='8'>Nenhuma tarefa partilhada encontrada.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>