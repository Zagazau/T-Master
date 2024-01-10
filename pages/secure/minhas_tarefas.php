<?php
// Certifique-se de incluir sua lógica de conexão com o banco de dados aqui
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
    $tarefas = $tarefaRepository->filtrarTarefas($estado, $prioridade);

    header("Location: main.php?prioridade=$prioridade&estado=$estado");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['prioridade']) && isset($_GET['estado'])) {
    $prioridade = $_GET['prioridade'];
    $estado = $_GET['estado'];

    $tarefas = $tarefaRepository->filtrarTarefas($estado, $prioridade);
}

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["pesquisar"]) && $_GET["pesquisar"] === "1" && isset($_GET["titulo_pesquisa"])) {
    $tituloPesquisa = $_GET["titulo_pesquisa"];
    $tarefas = $tarefaRepository->pesquisarTarefa($tituloPesquisa);
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
                            <a href="info.php" data-bs-toggle="col lapse" class="nav-link px-0 align-middle">
                                <i class="bi bi-question-circle"></i>
                                <span class="ms-1 d-  e d-sm-inline">Informação</span>
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
                        <a href="perfil.php" class="d-flex align-items-center text-white text-decoration-none"
                            id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://github.com/mdo.png" alt="hugenerd" width="30" height="30"
                                class="rounded-circle">
                            <span class="d-none d-sm-inline mx-1">Aparecer Nome</span>
                        </a>
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

                            <button type="submit" class="btn btn-outline-success">Filtrar</button>
                        </form>

                        <form action="#" method="get" class="form-inline">
                            <input type="hidden" name="pesquisar" value="1">

                            <label for="titulo_pesquisa" class="mr-2">Pesquisar (Por Título):</label>
                            <input type="text" id="titulo_pesquisa" name="titulo_pesquisa" class="form-control mr-2"
                                required>

                            <button type="submit" class="btn btn-outline-success">Pesquisar</button>
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
                                                class="btn btn-primary">Editar</a>
                                            <form action="/tmaster/pages/secure/excluir_tarefa.php" method="post"
                                                onsubmit="return confirm('Tem certeza que deseja excluir esta tarefa?');">
                                                <input type="hidden" name="tarefa_id" value="<?= $tarefa['id'] ?>">
                                                <button type="submit" class="btn btn-danger">Excluir</button>
                                            </form>
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

</body>

</html>