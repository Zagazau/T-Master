<?php
require_once __DIR__ . '/../../infra/middlewares/middleware-user.php';

require_once __DIR__ . '/../../infra/repositories/tarefaRepository.php';

$tarefaRepository = new TarefaRepository();


$tarefa_id = isset($_GET['tarefa_id']) ? $_GET['tarefa_id'] : null;


if (!$tarefa_id) {

    header('Location: /main.php');
    exit();
}


$tarefa_existente = $tarefaRepository->getTarefaById($tarefa_id);


if (!$tarefa_existente) {

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
    <style>
        body {
            background-image: url('../../assets/images/fundo.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
</head>

<body>

    <div class="container-fluid">
        <div class="row flex-nowrap">
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


            <div class="col">
                <div class="container mt-5">
                    <h2 class="mb-4">Editar Tarefa</h2>
                    <form action="/tmaster/pages/public/processar_edicao.php" method="post" class="needs-validation"
                        novalidate>
                        <input type="hidden" name="tarefa_id" value="<?= $tarefa_existente['id'] ?>">

                        <div class="form-group">
                            <label for="novo_titulo">Título:</label>
                            <input type="text" id="novo_titulo" name="novo_titulo" class="form-control"
                                value="<?= $tarefa_existente['titulo'] ?>" required>
                            <div class="invalid-feedback">Por favor, preencha este campo.</div>
                        </div>

                        <div class="form-group">
                            <label for="nova_descricao">Descrição:</label>
                            <textarea id="nova_descricao" name="nova_descricao" class="form-control"
                                rows="4"><?= $tarefa_existente['descricao'] ?></textarea>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nova_data_inicio"> Data de Início:</label>
                                <input type="date" id="nova_data_inicio" name="nova_data_inicio"
                                    value="<?= $tarefa_existente['data_inicio'] ?>" class="form-control">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="nova_data_fim">Data de Fim:</label>
                                <input type="date" id="nova_data_fim" name="nova_data_fim"
                                    value="<?= $tarefa_existente['data_fim'] ?>" class="form-control">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nova_prioridade">Prioridade (de 1 a 5):</label>
                                <select id="nova_prioridade" name="nova_prioridade" class="form-control">
                                    <option value="1" <?= $tarefa_existente['prioridade'] == 1 ? 'selected' : '' ?>>1
                                    </option>
                                    <option value="2" <?= $tarefa_existente['prioridade'] == 2 ? 'selected' : '' ?>>2
                                    </option>
                                    <option value="3" <?= $tarefa_existente['prioridade'] == 3 ? 'selected' : '' ?>>3
                                    </option>
                                    <option value="4" <?= $tarefa_existente['prioridade'] == 4 ? 'selected' : '' ?>>4
                                    </option>
                                    <option value="5" <?= $tarefa_existente['prioridade'] == 5 ? 'selected' : '' ?>>5
                                    </option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="novo_estado">Estado:</label>
                                <select id="novo_estado" name="novo_estado" class="form-control">
                                    <option value="Por fazer" <?= $tarefa_existente['estado'] == 'Por fazer' ? 'selected' : '' ?>>Por fazer</option>
                                    <option value="A ser feita" <?= $tarefa_existente['estado'] == 'A ser feita' ? 'selected' : '' ?>>A ser feita</option>
                                    <option value="Terminada" <?= $tarefa_existente['estado'] == 'Terminada' ? 'selected' : '' ?>>Terminada</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="nova_favorita" name="nova_favorita"
                                <?= $tarefa_existente['favorita'] ? 'checked' : '' ?>>
                            <label class="form-check-label" for="nova_favorita">Favorita</label>
                        </div>

                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>