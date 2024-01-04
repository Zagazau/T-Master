<?php
// Inclua o arquivo que contém a classe TarefaRepository
require_once __DIR__ . '/../../infra/repositories/tarefaRepository.php';

// Crie uma instância do TarefaRepository
$tarefaRepository = new TarefaRepository();

// Obtenha o ID da tarefa da consulta GET
$tarefa_id = isset($_GET['tarefa_id']) ? $_GET['tarefa_id'] : null;

// Verifique se o ID é válido
if (!$tarefa_id) {
    // Redirecione de volta à página principal ou mostre uma mensagem de erro
    header('Location: /main.php');
    exit();
}

// Obtenha os detalhes da tarefa com base no ID
$tarefa_existente = $tarefaRepository->getTarefaById($tarefa_id);

// Verifique se a tarefa existe
if (!$tarefa_existente) {
    // Redirecione de volta à página principal ou mostre uma mensagem de erro
    header('Location: /main.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../assets/css/editar_tarefa.css">
</head>

<body>

    <div class="container-fluid">
        <div class="row flex-nowrap">
            <!-- Barra de Navegação -->
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0" style="background-color: #8f8f8f;">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <a href="/"
                        class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <img src="../../assets/images/Logo1.png" alt="Logo" width="100" height="100">
                    </a>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start"
                        id="menu">
                        <li class="nav-item">
                            <a href="main.php" class="nav-link align-middle px-0">
                                <i class="bi bi-house-door"></i>
                                <span class="ms-1 d-none d-sm-inline">Home</span>
                            </a>
                        </li>
                        <hr>
                        <li class="nav-item">
                            <a href="minhas_tarefas.php" class="nav-link align-middle px-0">
                                <i class="bi bi-list-task"></i>
                                <span class="ms-1 d-none d-sm-inline">As minhas tarefas</span>
                            </a>
                        </li>
                        <hr>
                        <li>
                            <a href="info.php" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                <i class="bi bi-question-circle"></i>
                                <span class="ms-1 d-none d-sm-inline">Informação</span>
                            </a>
                        </li>
                        <hr>
                        <li>
                            <a href="#" class="nav-link px-0 align-middle">
                                <i class="bi-box-arrow-right"></i>
                                <span class="ms-1 d-none d-sm-inline">Sign Out</span>
                            </a>
                        </li>
                    </ul>
                    <hr>
                    <div class="dropdown pb-4">
                        <a href="perfil.php"
                            class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                            id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://github.com/mdo.png" alt="hugenerd" width="30" height="30"
                                class="rounded-circle">
                            <span class="d-none d-sm-inline mx-1">Aparecer Nome</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Formulário de Edição -->
            <div class="col">
                <div class="container mt-5">
                    <h2 class="mb-4">Editar Tarefa</h2>
                    <form action="/tmaster/pages/public/processar_edicao.php" method="post">
                        <input type="hidden" name="tarefa_id" value="<?= $tarefa_existente['id'] ?>">

                        <div class="mb-3">
                            <label for="novo_titulo" class="form-label">Novo Título:</label>
                            <input type="text" id="novo_titulo" name="novo_titulo" class="form-control"
                                value="<?= $tarefa_existente['titulo'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="nova_descricao" class="form-label">Nova Descrição:</label>
                            <textarea id="nova_descricao" name="nova_descricao" class="form-control"
                                rows="4"><?= $tarefa_existente['descricao'] ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="nova_data_inicio" class="form-label">Nova Data de Início:</label>
                            <input type="date" id="nova_data_inicio" name="nova_data_inicio"
                                value="<?= $tarefa_existente['data_inicio'] ?>" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="nova_data_fim" class="form-label">Nova Data de Fim:</label>
                            <input type="date" id="nova_data_fim" name="nova_data_fim"
                                value="<?= $tarefa_existente['data_fim'] ?>" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="nova_prioridade" class="form-label">Nova Prioridade (de 1 a 5):</label>
                            <select id="nova_prioridade" name="nova_prioridade" class="form-select">
                                <option value="1" <?= $tarefa_existente['prioridade'] == 1 ? 'selected' : '' ?>>1</option>
                                <option value="2" <?= $tarefa_existente['prioridade'] == 2 ? 'selected' : '' ?>>2</option>
                                <option value="3" <?= $tarefa_existente['prioridade'] == 3 ? 'selected' : '' ?>>3</option>
                                <option value="4" <?= $tarefa_existente['prioridade'] == 4 ? 'selected' : '' ?>>4</option>
                                <option value="5" <?= $tarefa_existente['prioridade'] == 5 ? 'selected' : '' ?>>5</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="novo_estado" class="form-label">Novo Estado:</label>
                            <select id="novo_estado" name="novo_estado" class="form-select">
                                <option value="Por fazer" <?= $tarefa_existente['estado'] == 'Por fazer' ? 'selected' : '' ?>>Por
                                    fazer</option>
                                <option value="A ser feita" <?= $tarefa_existente['estado'] == 'A ser feita' ? 'selected' : '' ?>>A
                                    ser feita</option>
                                <option value="Terminada" <?= $tarefa_existente['estado'] == 'Terminada' ? 'selected' : '' ?>>
                                    Terminada</option>
                            </select>
                        </div>

                        <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" id="nova_favorita" name="nova_favorita"
                                <?= $tarefa_existente['favorita'] ? 'checked' : '' ?>>
                            <label class="form-check-label" for="nova_favorita">Nova Favorita</label>
                        </div>

                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Certifique-se de incluir Bootstrap JS e outros scripts necessários -->

</body>

</html>