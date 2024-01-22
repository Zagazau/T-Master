<?php
require_once __DIR__ . '/../../infra/db/connection.php';
require_once __DIR__ . '/../../infra/repositories/userRepository.php';
require_once __DIR__ . '/../../infra/middlewares/middleware-user.php';

$user = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    var_dump($_FILES);

    if (!empty($_FILES['foto_perfil']['name'])) {
        $fotoPerfilTmpName = $_FILES['foto_perfil']['tmp_name'];
        $fotoPerfilData = file_get_contents($fotoPerfilTmpName);
    } else {
        $fotoPerfilData = $userData['foto_perfil'];
    }

    $userId = $_SESSION['id'];

    if ($userData = getById($userId)) {
        $novoNome = isset($_POST['nome']) ? $_POST['nome'] : $userData['nome'];
        $novoEmail = isset($_POST['email']) ? $_POST['email'] : $userData['email'];
        $novoUsername = isset($_POST['username']) ? $_POST['username'] : $userData['username'];

        updateUser([
            'id' => $userId,
            'nome' => $novoNome,
            'email' => $novoEmail,
            'username' => $novoUsername,
            'foto_perfil' => $fotoPerfilData,
        ]);
        header("Location: /tmaster/pages/secure/perfil.php");
        exit();
    }
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
    <link href="/../../assets/js/func.js">
    </script>
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


    <script>
        function previewImage(input) {
            var preview = document.getElementById('preview');
            var file = input.files[0];
            var reader = new FileReader();

            reader.onloadend = function () {
                preview.src = reader.result;
            }

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = "data:image/jpeg;base64,<?= base64_encode($user['foto_perfil']) ?>";
            }
        }
    </script>
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


            <div class="container-fluid">
                <div class="row justify-content-center align-items-start">
                    <div class="col-md-12 text-center">
                        <h1 class="mt-4 text-left">Perfil</h1>
                        <hr>

                        <form action="/tmaster/pages/secure/perfil.php" method="post" enctype="multipart/form-data">
                            <div class="d-flex flex-column align-items-center text-center p-3 py-1 position-relative">
                                <div class="form-group mb-2">
                                    <label for="foto_perfil" class="labels mt-1 mb-1">Foto de Perfil</label>
                                    <input type="file" id="foto_perfil" name="foto_perfil" class="form-control-file"
                                        onchange="previewImage(this)">
                                    <img id="preview"
                                        src="data:image/jpeg;base64,<?= base64_encode($user['foto_perfil']) ?>" alt=""
                                        width="100" height="100" class="rounded-circle">
                                </div>
                                <span class="font-weight-bold mt-1">
                                    <?= $user['username'] ?>
                                </span>
                                <div class="mt-2 text-center">
                                    <button type="submit" name="submit" class="btn btn-success">
                                        Atualizar Foto de Perfil
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>


                    <div class="col-md-6 mt-3 mt-md-0">
                        <div class="p-3 py-2">
                            <form action="/tmaster/pages/secure/perfil.php" method="post">
                                <div class="form-group mb-2">
                                    <label for="nome" class="labels mt-1 mb-1">Nome Completo</label>
                                    <input type="text" id="nome" name="nome" class="form-control"
                                        value="<?= $user['nome'] ?>">
                                </div>
                                <div class="form-group mb-2">
                                    <label for="username" class="labels mt-1 mb-1">Username</label>
                                    <input type="username" id="username" name="username" class="form-control"
                                        value="<?= $user['username'] ?>">
                                </div>
                                <div class="form-group mb-2">
                                    <label for="email" class="labels mt-1 mb-1">Email</label>
                                    <input type="email" id="email" name="email" class="form-control"
                                        value="<?= $user['email'] ?>">
                                </div>
                                <hr>
                                <div class="mt-2 text-center">
                                    <button type="submit" name="submit" class="btn btn-info">
                                        Guardar Alterações
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>