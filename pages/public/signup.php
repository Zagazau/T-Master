<?php
require_once __DIR__ . '/../../infra/middlewares/middleware-not-authenticated.php';
require_once __DIR__ . '/../../controllers/admin/user.php';
$title = '- Sign Up';
?>

<main>
    <section>
        <?php
    if (isset($_SESSION['success'])) {
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
      echo $_SESSION['success'] . '<br>';
      echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
      unset($_SESSION['success']);
    }
    if (isset($_SESSION['errors'])) {
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
      foreach ($_SESSION['errors'] as $error) {
        echo $error . '<br>';
      }
      echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
      unset($_SESSION['errors']);
    }
    ?>
    </section>

    <!DOCTYPE html PUBLIC>

    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="../../assets/css/signup.css">
        <script src="../../assets/js/func.js"></script>
    </head>

    <body>
        <main>
            <section>
                <?php
            if (isset($_SESSION['success'])) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
                echo $_SESSION['success'] . '<br>';
                echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                unset($_SESSION['success']);
            }
            if (isset($_SESSION['errors'])) {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                foreach ($_SESSION['errors'] as $error) {
                    echo $error . '<br>';
                }
                echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                unset($_SESSION['errors']);
            }
            ?>
            </section>

            <section class="vh-100 bg-image">
                <div class="mask d-flex align-items-center h-100 gradient-custom-3">
                    <div class="container h-100">
                        <div class="row d-flex justify-content-center align-items-center h-100">
                            <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                                <div class="card" style="border-radius: 15px;">
                                    <div class="card-body p-5">
                                        <a href="#" class="text-body" onclick="voltarParaPaginaAnterior()">&#8592;
                                            Voltar</a>
                                        <h2 class="text-uppercase text-center mb-5 mx-auto">Criar Conta</h2>

                                        <form method="POST" action="/tmaster/controllers/auth/signup.php">
                                            <div class="form-outline mb-4">
                                                <input type="text" name="nome" id="name"
                                                    class="form-control form-control-lg" placeholder="Nome" />
                                            </div>

                                            <div class="form-outline mb-4">
                                                <input type="email" name="email" id="email"
                                                    class="form-control form-control-lg" placeholder="Email" />
                                            </div>

                                            <div class="form-outline mb-4">
                                                <input type="text" name="username" id="username"
                                                    class="form-control form-control-lg" placeholder="Username" />
                                            </div>

                                            <div class="form-outline mb-4">
                                                <input type="password" name="password" id="password"
                                                    class="form-control form-control-lg" placeholder="Password" />
                                            </div>

                                            <!-- Adicione outros campos do formulário conforme necessário -->

                                            <div class="d-flex justify-content-center">
                                                <button class="btn btn-outline-light btn-lg px-4 mt-3" type="submit"
                                                    name="user" value="signUp">Registar</button>
                                            </div>

                                            <p class="text-center text-muted mt-5 mb-0">Já tens conta? <a
                                                    href="./signin.php" class="fw-bold text-body"><u>Entra aqui!</u></a>
                                            </p>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </body>

    </html>