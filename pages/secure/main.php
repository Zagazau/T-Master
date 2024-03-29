<?php

require_once __DIR__ . '/../../infra/middlewares/middleware-user.php';
require_once __DIR__ . '/../../infra/db/connection.php';
require_once __DIR__ . '/../../infra/repositories/tarefaRepository.php';


$tarefaRepository = new tarefaRepository();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["user"]) && $_POST["user"] === "addTask") {
    $titulo = $_POST["titulo"];
    $descricao = $_POST["descricao"];
    $data_inicio = $_POST["data_inicio"];
    $data_fim = $_POST["data_fim"];
    $prioridade = $_POST["prioridade"];
    $estado = $_POST["estado"];
    $favorita = isset($_POST["favorita"]) ? 1 : 0;


    $tarefaRepository->createTarefa($titulo, $descricao, $data_inicio, $data_fim, $prioridade, $estado, $favorita);

    header("Location: /main.php");
    exit();
}

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="mt-3">Bem-vindo,
                        <?= $_SESSION['user']['nome']; ?>!
                    </h1>
                    <h2 id="current-time" class="h2 text-dark p-3 rounded text-center mt-3"></h2>

                </div>
                <hr>
                <br>


                <div class="container">
                    <h4>As tuas tarefas</h4>
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
                                <?php endforeach; ?>
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addtarefaModal">
                        Adicionar Tarefa
                    </button>

                    <div class="modal fade" id="addtarefaModal" tabindex="-1" aria-labelledby="adtarefaLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addTaskModalLabel">Adicionar uma Tarefa</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="/tmaster/pages/public/processar_tarefa.php"
                                        action="/tmaster/pages/public/processar_edicao.php"
                                        action="/tmaster/pages/secure/excluir_tarefa.php" method="post" class="my-4">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="titulo" class="form-label">Título:</label>
                                                <input type="text" id="titulo" name="titulo" class="form-control"
                                                    required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="descricao" class="form-label">Descrição:</label>
                                                <textarea id="descricao" name="descricao"
                                                    class="form-control"></textarea>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="data_inicio" class="form-label">Data de Início:</label>
                                                <input type="date" id="data_inicio" name="data_inicio"
                                                    class="form-control" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="data_fim" class="form-label">Data de Fim:</label>
                                                <input type="date" id="data_fim" name="data_fim" class="form-control">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="prioridade" class="form-label">Prioridade (de 1 a
                                                    5):</label>
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
                                            <input type="checkbox" class="form-check-input" name="favorita"
                                                id="favorita">
                                            <label class="form-check-label" for="favorita">Favorita</label>
                                        </div>

                                        <button type="submit" class="btn btn-success " name="user"
                                            value="addTask">Adicionar Tarefa</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</body>

<script>
    function updateClock() {
        var currentTime = new Date();
        var hours = currentTime.getHours();
        var minutes = currentTime.getMinutes();
        var seconds = currentTime.getSeconds();

        var formattedTime = hours + ":" + (minutes < 10 ? "0" : "") + minutes + ":" + (seconds < 10 ? "0" : "") + seconds;

        document.getElementById('current-time').innerText = formattedTime;
    }

    setInterval(updateClock, 1000);
    updateClock();
</script>



</html>