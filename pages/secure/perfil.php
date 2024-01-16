<?php
require_once __DIR__ . '/../../infra/db/connection.php';
require_once __DIR__ . '/../../infra/repositories/userRepository.php';
session_start();


//Não está a funcionar o update À bd
$user = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $novoNome = isset($_POST['nome']) ? $_POST['nome'] : null;
    $novoEmail = isset($_POST['email']) ? $_POST['email'] : null;
    $novoUsername = isset($_POST['username']) ? $_POST['username'] : null;

    $userId = $_SESSION['id'];

    $usuarioExistente = getById($userId);


    $novoNome = $novoNome ?? $usuarioExistente['nome'];
    $novoEmail = $novoEmail ?? $usuarioExistente['email'];
    $novoUsername = $novoUsername ?? $usuarioExistente['username'];


    updateUser([
        'id' => $userId,
        'nome' => $novoNome,
        'email' => $novoEmail,
        'username' => $novoUsername,
    ]);


    header("Location: /perfil.php");
    exit();
}

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];

    $PDOStatement = $GLOBALS['pdo']->prepare('SELECT * FROM utilizadores WHERE id = ?;');
    $PDOStatement->bindValue(1, $id, PDO::PARAM_INT);
    $PDOStatement->execute();
    $user = $PDOStatement->fetch();
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
    <script src="/../../assets/js/func.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        .container-fluid {
            background-image: url('../../assets/images/fundo.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;

        }
    </style>
</head>

<body>

    <div class="container-fluid">
        <div class="row flex-nowrap">

            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0" style="background-color: #8f8f8f; min-width: 200px;">
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
                            <a href="#" class="nav-link px-0 align-middle">
                                <i class="bi-box-arrow-right"></i>
                                <span class="ms-1 d-none d-sm-inline">Sign Out</span>
                            </a>
                        </li>

                    </ul>
                    <hr>
                    <div class="dropdown pb-4">
                        <a href="perfil.php" class="d-flex align-items-center text-white text-decoration-none "
                            id="utilizador">
                            <img src="https://github.com/mdo.png" width="30" height="30" class="rounded-circle">
                            <span class="d-none d-sm-inline mx-1">Aparecer Nome</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="container rounded bg-white my-5 mt-3">
                <div class="row justify-content-center align-items-start">
                    <div class="col-md-12 text-center">
                        <h1 class="mt-4">Perfil</h1>
                        <form action="/upload" method="post" enctype="multipart/form-data">
                            <div class="d-flex flex-column align-items-center text-center p-3 py-1 position-relative">
                                <label for="perfilImageInput">
                                    <img id="perfilImage" class="rounded-circle img-fluid" width="90px"
                                        src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                                </label>
                                <input type="file" id="perfilImageInput" name="perfilImage" accept="image/*"
                                    style="display: none;" onchange="displayImage(this)">
                                <span class="font-weight-bold mt-1">
                                    <?= $user['username'] ?>
                                </span>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6 mt-3 mt-md-0">
                        <div class="p-3 py-5">
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="labels mt-1 mb-1">Nome Completo</label>
                                    <p class="form-control mb-3">
                                        <?= $user['nome'] ?>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="labels mt-1 mb-0">Email</label>
                                    <p class="form-control mb-0">
                                        <?= $user['email'] ?>
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="mt-2 text-center">
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#editarPerfilModal">
                                    Editar Perfil
                                </button>
                            </div>

                            <div class="modal fade" id="editarPerfilModal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Editar Perfil</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="mb-3">
                                                <label for="nome" class="form-label">Nome: </label>
                                                <input type="text" id="nome" name="nome" class="form-control"
                                                    value="<?= $user['nome'] ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">E-mail: </label>
                                                <input type="text" id="email" name="email" class="form-control"
                                                    value="<?= $user['email'] ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="username" class="form-label">Username:</label>
                                                <input type="text" id="username" name="username" class="form-control"
                                                    value="<?= $user['username'] ?>" required>
                                            </div>

                                            <div class="text-end">
                                                <button type="submit" class="btn btn-success"
                                                    data-dismiss="modal">Guardar Alterações</button>
                                                <button type="button" class="btn btn-primary ml-2" data-toggle="modal"
                                                    data-target="#alterarSenhaModal">
                                                    Alterar Password
                                                </button>
                                            </div>

                                            <div class="modal fade" id="alterarSenhaModal" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Alterar
                                                                Password
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="PassAtual" class="form-label">Password
                                                                    Atual:</label>
                                                                <input type="password" id="PassAtual" name="PassAtual"
                                                                    class="form-control" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="novaPass" class="form-label">Nova
                                                                    Password:</label>
                                                                <input type="password" id="novaPass" name="novaPass"
                                                                    class="form-control" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="confirmarPass" class="form-label">Confirmar
                                                                    Passsword:</label>
                                                                <input type="password" id="confirmarPass"
                                                                    name="confirmarPass" class="form-control" required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-success"
                                                                data-dismiss="modal">Guardar Alterações</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>