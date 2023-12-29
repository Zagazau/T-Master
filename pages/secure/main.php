<?php
// Certifique-se de incluir sua lógica de conexão com o banco de dados aqui
require_once __DIR__ . '/../../infra/middlewares/middleware-not-authenticated.php';
require_once __DIR__ . '/../../infra/db/connection.php';
require_once __DIR__ . '/../../infra/repositories/tarefaRepository.php';

// Instancia o t
$tarefaRepository = new tarefaRepository();

// Processa o formulário de adição de tarefa
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["user"]) && $_POST["user"] === "addTask") {
    $titulo = $_POST["titulo"];
    $descricao = $_POST["descricao"];
    $data_inicio = $_POST["data_inicio"];
    $data_fim = $_POST["data_fim"];
    $prioridade = $_POST["prioridade"];
    $estado = $_POST["estado"];
    $favorita = isset($_POST["favorita"]) ? 1 : 0;

    // Adiciona a tarefa
    $tarefaRepository->createTarefa($titulo, $descricao, $data_inicio, $data_fim, $prioridade, $estado, $favorita);

    // Redireciona para evitar envios duplos do formulário
    header("Location: /main.php");
    exit();
}

// Consulta o banco de dados para obter as tarefas
$tarefas = $tarefaRepository->getAllTarefas();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../assets/css/main.css">
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
                            <a href="perfil.php" class="nav-link align-middle px-0">
                                <i class="bi bi-person"></i>
                                <span class="ms-1 d-none d-sm-inline">Perfil</span>
                            </a>
                        </li>
                        <hr>
                        <li class="nav-item">
                            <a href="/tmaster/pages/public/minhas_tarefas.php" class="nav-link align-middle px-0">
                                <i class="bi bi-person"></i>
                                <span class="ms-1 d-none d-sm-inline">As minhas tarefas</span>
                            </a>
                        </li>
                        <hr>
                        <li>
                            <a href="#" data-bs-toggle="col lapse" class="nav-link px-0 align-middle">
                                <i class="bi bi-question-circle"></i>
                                <span class="ms-1 d-  e d-sm-inline">Ajuda</span>
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
                        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                            id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://github.com/mdo.png" alt="hugenerd" width="30" height="30"
                                class="rounded-circle">
                            <span class="d-none d-sm-inline mx-1">Aparecer Nome</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-9 col-xl-10">
                <h1 class="mt-3">Bem-vindo,
                    <?= $user['nome'] ?? null ?>!
                </h1>

                <div class="container">
                    <table class="table table-striped table-bordered mt-4">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Título</th>
                                <th>Descrição</th>
                                <th>Data de Início</th>
                                <th>Data de Fim</th>
                                <th>Prioridade</th>
                                <th>Estado</th>
                                <th>Favorita</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tarefas as $tarefa): ?>
                                <tr>
                                    <td>
                                        <?= $tarefa['id'] ?>
                                    </td>
                                    <td>
                                        <?= $tarefa['titulo'] ?>
                                    </td>
                                    <td>
                                        <?= $tarefa['descricao'] ?>
                                    </td>
                                    <td>
                                        <?= $tarefa['data_inicio'] ?>
                                    </td>
                                    <td>
                                        <?= $tarefa['data_fim'] ?>
                                    </td>
                                    <td>
                                        <?= $tarefa['prioridade'] ?>
                                    </td>
                                    <td>
                                        <?= $tarefa['estado'] ?>
                                    </td>
                                    <td>
                                        <?= $tarefa['favorita'] ? 'Sim' : 'Não' ?>
                                    </td>
                                    <td>
                                        <a href="/tmaster/pages/secure/editar_tarefa.php?tarefa_id=<?= $tarefa['id'] ?>"
                                            class="btn btn-primary">Editar</a>
                                        <a href="/tmaster/pages/secure/excluir_tarefa.php?tarefa_id=<?= $tarefa['id'] ?>"
                                            class="btn btn-danger">Excluir</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <hr>


                    <form action="/tmaster/pages/public/processar_tarefa.php"
                        action="/tmaster/pages/public/processar_edicao.php"
                        action="/tmaster/pages/public/excluir_tarefa.php" method="post" class="my-4">
                        <h4 class="mb-4">Adicionar uma Tarefa</h4>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="titulo" class="form-label">Título:</label>
                                <input type="text" id="titulo" name="titulo" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="descricao" class="form-label">Descrição:</label>
                                <textarea id="descricao" name="descricao" class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="data_inicio" class="form-label">Data de Início:</label>
                                <input type="date" id="data_inicio" name="data_inicio" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="data_fim" class="form-label">Data de Fim:</label>
                                <input type="date" id="data_fim" name="data_fim" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="prioridade" class="form-label">Prioridade (de 1 a 5):</label>
                                <select id="prioridade" name="prioridade" class="form-select">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="estado" class="form-label">Estado:</label>
                                <select id="estado" name="estado" class="form-select">
                                    <option value="Por fazer">Por fazer</option>
                                    <option value="A ser feita">A ser feita</option>
                                    <option value="Terminada">Terminada</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" name="favorita" id="favorita">
                            <label class="form-check-label" for="favorita">Favorita</label>
                        </div>

                        <button type="submit" class="btn btn-primary" name="user" value="addTask">Adicionar
                            Tarefa</button>
                    </form>
                    </table>

                    <?php foreach ($tarefas as $tarefa): ?>
                        <!-- Modal de edição -->
                        <div class="modal fade" id="editarModal<?= $tarefa['id'] ?>" tabindex="-1" role="dialog"
                            aria-labelledby="editarModalLabel" aria-hidden="true">
                            <!-- Conteúdo do modal de edição -->
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editarModalLabel">Editar Tarefa</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Formulário de edição -->
                                        <form action="/tmaster/pages/public/processar_edicao.php" method="post">
                                            <input type="hidden" name="tarefa_id" value="<?= $tarefa['id'] ?>">

                                            <!-- Campos de edição -->
                                            <label for="titulo">Novo Título:</label>
                                            <input type="text" name="novo_titulo" value="<?= $tarefa['titulo'] ?>" required>

                                            <label for="descricao">Nova Descrição:</label>
                                            <textarea name="nova_descricao"><?= $tarefa['descricao'] ?></textarea>

                                            <!-- Adicione outros campos conforme necessário -->
                                            <!-- Botão de submit -->
                                            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal de exclusão -->
                        <div class="modal fade" id="excluirModal<?= $tarefa['id'] ?>" tabindex="-1" role="dialog"
                            aria-labelledby="excluirModalLabel" aria-hidden="true">
                            <!-- Conteúdo do modal de exclusão -->
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="excluirModalLabel">Confirmar Exclusão</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Você tem certeza que deseja excluir esta tarefa?</p>
                                        <!-- Formulário de exclusão -->
                                        <form action="/tmaster/pages/public/processar_exclusao.php" method="post">
                                            <input type="hidden" name="tarefa_id" value="<?= $tarefa['id'] ?>">
                                            <!-- Botão de submit -->
                                            <button type="submit" class="btn btn-danger">Sim, Excluir</button>
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cancelar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

</body>

</html>