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
                            <a href="minhas_tarefas.php" class="nav-link align-middle px-0">
                                <i class="bi bi-person"></i>
                                <span class="ms-1 d-none d-sm-inline">As minhas tarefas</span>
                            </a>
                        </li>
                        <hr>
                        <li>
                            <a href="#" data-bs-toggle="col lapse" class="nav-link px-0 align-middle">
                                <i class="bi bi-question-circle"></i>
                                <span class="ms-1 d- e d-sm-inline">Ajuda</span>
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
                            <img src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"
                                alt="hugenerd" width="30" height="30" class="rounded-circle">
                            <span class="d-none d-sm-inline mx-1">Aparecer nome</span>
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
                                    <img id="perfilImage" class="rounded-circle" width="120px"
                                        src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                                    <button type="button" class="btn btn-link btn-edit-profile">
                                        <i class="bi bi-plus"></i>
                                    </button>
                                </label>
                                <input type="file" id="perfilImageInput" name="perfilImage" accept="image/*"
                                    style="display: none;" onchange="displayImage(this)">
                                <span class="font-weight-bold mt-1">Aparecer username</span>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 py-5">
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <label class="labels">Nome </label>
                                    <input type="text" class="form-control" placeholder="Aparecer nome completo"
                                        value="">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <label class="labels">Email </label>
                                    <input type="text" class="form-control" placeholder="Aparecer email" value="">
                                </div>
                            </div>
                            <div class="mt-3 text-center">
                                <button class="btn btn-primary profile-button" type="button">Editar perfil</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>