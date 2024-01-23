<?php
require_once __DIR__ . '/../../infra/middlewares/middleware-user.php';
require_once __DIR__ . '/../../infra/db/connection.php';
require_once __DIR__ . '/../../infra/repositories/tarefaRepository.php';

$tarefaRepository = new tarefaRepository();

$tarefas = $tarefaRepository->getAllTarefas();

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["filtrar"])) {
    if (isset($_GET['prioridade']) && isset($_GET['estado'])) {
        $prioridade = $_GET['prioridade'];
        $estado = $_GET['estado'];
    }
    $estado = isset($_GET['estado']) ? $_GET['estado'] : '';
    $prioridade = isset($_GET['prioridade']) ? $_GET['prioridade'] : '';

    $tarefas = $tarefaRepository->filtrarTarefas($_SESSION['id'], $estado, $prioridade);

    header("Location: main.php?prioridade=$prioridade&estado=$estado");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['prioridade']) && isset($_GET['estado'])) {
    $prioridade = $_GET['prioridade'];
    $estado = $_GET['estado'];

    $tarefas = $tarefaRepository->filtrarTarefas($_SESSION['id'], $estado, $prioridade);
}

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["pesquisar"]) && $_GET["pesquisar"] === "1" && isset($_GET["titulo_pesquisa"])) {
    $tituloPesquisa = $_GET["titulo_pesquisa"];
    $tarefas = $tarefaRepository->pesquisarTarefa($_SESSION['id'], $tituloPesquisa);
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
    <link rel="stylesheet" href="../../assets/css/main.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
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
                            <a href="info.php" class="nav-link px-0 align-middle">
                                <i class="bi bi-calendar"></i>
                                <span class="ms-1 d-none d-sm-inline">Calendário</span>
                            </a>
                        </li>
                        <hr>
                        <li>
                            <a href="partilhar.php" class="nav-link px-0 align-middle">
                                <i class="bi bi-share"></i>
                                <span class="ms-1 d-none d-sm-inline">Partilhar</span>
                            </a>
                        </li>
                        <hr>
                        <li>
                            <a href="#confirmLogoutModal" class="nav-link px-0 align-middle" data-toggle="modal">
                                <i class="bi-box-arrow-right"></i>
                                <span class="ms-1 d-none d-sm-inline">Sign Out</span>
                            </a>
                        </li>
                    </ul>
                    <hr>
                    <div class="dropdown pb-4">
                        <a href="perfil.php" class="d-flex align-items-center text-white text-decoration-none"
                            id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"" alt="
                                hugenerd" width="30" height="30" class="rounded-circle">
                            <span class="d-none d-sm-inline mx-1">
                                <?= $_SESSION['user']['nome']; ?>
                            </span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- MODAL DE CONFRIMAÇÃO DE LOGOUT-->
            <div class="modal fade" id="confirmLogoutModal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Terminar Sessão</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Tem a certeza de que deseja sair?
                        </div>
                        <div class="modal-footer">
                            <a href="/tmaster/controllers/auth/signin.php?user=logout" class="btn btn-danger">Sim</a>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-9 col-xl-10">
                <h1 class="mt-3">As Minhas Tarefas</h1>
                <hr>
                <br>
                <div class="container">
                    <div class="mb-3">
                        <form action="#" method="get" class="form-inline mb-2">
                            <label for="prioridade" class="mr-2">Prioridade:</label>
                            <select id="prioridade" name="prioridade" class="form-control mr-2">
                                <option value="">Todas</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>

                            <label for="estado" class="mr-2">Estado:</label>
                            <select id="estado" name="estado" class="form-control mr-2">
                                <option value="">Todos</option>
                                <option value="Por fazer">Por fazer</option>
                                <option value="A ser feita">A ser feita</option>
                                <option value="Terminada">Terminada</option>
                            </select>

                            <button type="submit" class="btn btn-info">Filtrar</button>
                        </form>

                        <form action="#" method="get" class="form-inline">
                            <input type="hidden" name="pesquisar" value="1">

                            <label for="titulo_pesquisa" class="mr-2">Pesquisar (Por Título):</label>
                            <input type="text" id="titulo_pesquisa" name="titulo_pesquisa" class="form-control mr-2"
                                required>

                            <button type="submit" class="btn btn-info">Pesquisar</button>
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
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tarefas as $tarefa): ?>
                                    <tr>
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
                                                class="btn btn-secondary">Editar</a>
                                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                                data-target="#confirmacaoExclusaoModal">
                                                Eliminar
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirmacaoExclusaoModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Tarefa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Tem a certeza que deseja eliminar a tarefa?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <form action="/tmaster/pages/secure/excluir_tarefa.php" method="post">
                        <input type="hidden" name="tarefa_id" value="<?= $tarefa['id'] ?>">
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>