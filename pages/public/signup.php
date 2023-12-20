<?php
require_once __DIR__ . '/../../infra/middlewares/middleware-not-authenticated.php';
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
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../assets/css/signup.css">
    <script src="../../assets/js/func.js"></script>
</head>


<section class="vh-100 bg-image"
style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body p-5">
              <div class="d-flex align-items-center mb-4">
                  <a href="#" class="text-body" onclick="voltarParaPaginaAnterior()">&#8592; Voltar</a>
                  <h2 class="text-uppercase text-center mb-5 mx-auto">Criar Conta</h2>
              </div>

              <form>

                <div class="form-outline mb-4">
                  <input type="text" id="form3Example1cg" class="form-control form-control-lg" placeholder="Nome" />
                </div>

                <div class="form-outline mb-4">
                  <input type="email" id="form3Example3cg" class="form-control form-control-lg" placeholder="Email" />
                </div>

                <div class="form-outline mb-4">
                  <input type="password" id="form3Example4cg" class="form-control form-control-lg" placeholder="Password" />
                </div>

                <div class="form-outline mb-4">
                  <input type="password" id="form3Example4cdg" class="form-control form-control-lg" placeholder="Repete a password" />
                </div>

                <div class="form-check text-center mb-5">
                  <input class="form-check-input" type="checkbox" id="formCheck1">
                  <label class="form-check-label" for="formCheck1">
                    Concordo com os <a href="#!" class="text-body"><u>termos de serviço</u></a>
                  </label>
                </div>

                <div class="d-flex justify-content-center">
                  <button type="button" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Registar</button>
                </div>

                <p class="text-center text-muted mt-5 mb-0">Já tens conta? <a href="./signin.php"
                    class="fw-bold text-body"><u>Entra aqui!</u></a>
                </p>

                <div class="d-flex justify-content-center mb-3">
                      <a href="../../index.php" class="btn btn-secondary btn-sm">Voltar</a>
                </div>

              </form>


            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

</main>

