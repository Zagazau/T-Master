<?php
//session_start();
require_once __DIR__ . '/../../infra/middlewares/middleware-not-authenticated.php';

//$title = ' - Sign In';
?>
<main>
  <section>
    <?php
    if (isset($_SESSION['errors'])) {
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
      foreach ($_SESSION['errors'] as $error) {
        echo $error . '<br>';
      }
      echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
      unset($_SESSION['errors']);
    }
    ?>


    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
      <link rel="stylesheet" href="../../assets/css/signin.css">
      <script src="../../assets/js/func.js"></script>
    </head>

    <section class=" vh-100 bg-custom">
      <div class="mask d-flex align-items-center h-100 gradient-custom-3">
        <div class="container h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-9 col-lg-7 col-xl-6">
              <div class="card" style="border-radius: 15px;">
                <div class="card-body p-5">
                  <a href="#" class="text-body" onclick="voltarParaPaginaAnterior()">&#8592; Voltar</a>
                  <h2 class="text-uppercase text-center mb-5">Login</h2>
                  <form action="/StreamSync/src/controllers/auth/login.php" method="POST">

                    <div class="form-outline mb-4">
                      <input type="email" id="form3Example3cg" class="form-control form-control-lg" placeholder="Email"
                        name="email" />
                    </div>

                    <div class="form-outline mb-4">
                      <input type="password" id="form3Example4cg" class="form-control form-control-lg"
                        placeholder="Password" name="password" />
                    </div>

                    <div class="form-check mb-5 text-center">
                      <div>
                        <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3cg" />
                        <label class="form-check-label text-center" for="form2Example3cg">
                          Guardar dados
                        </label>
                      </div>
                    </div>

                    <div class="d-flex justify-content-center">
                      <input type="submit" class="btn btn-success btn-block btn-lg text-white"
                        href="../../pages/public/main.php" class="gradient-custom-4" value="Login">
                    </div>

                  </form>

                  <p class="text-center text-muted mt-5 mb-0">Não tens conta? <a href="./signup.php"
                      class="fw-bold text-body"><u>Cria agora</u></a>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>