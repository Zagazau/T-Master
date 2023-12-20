<?php
require_once __DIR__ . '/../../infra/middlewares/middleware-not-authenticated.php';
include_once __DIR__ . '../../../templates/header.php';

$title = ' - Sign In';




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

    <section class="vh-100">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6 text-black">

            <div class="px-5 ms-xl-4">
              <img class="header-logo" src="./assets/images/Logo1.png" alt="">
            </div>

            <img class="header-logo" src="./assets/images/Logo1.png" alt="">

            <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">

              <form style="width: 23rem;">

                <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Log in</h3>

                <div class="form-outline mb-4">
                  <input type="email" id="form2Example18" class="form-control form-control-lg" placeholder="Email" />
                </div>

                <div class="form-outline mb-4">
                  <input type="password" id="form2Example28" class="form-control form-control-lg"
                    placeholder="password" />
                </div>

                <div class="pt-1 mb-4">
                  <button class="btn btn-info btn-lg btn-block" type="button">Login</button>
                </div>

                <p class="small mb-5 pb-lg-2"><a class="text-muted" href="#!">Forgot password?</a></p>
                <p>Não tens conta? <a href="./pages/public/signup.php" class="link-info">Regista-te aqui</a></p>

              </form>

            </div>

          </div>
          <div class="col-sm-6 px-0 d-none d-sm-block">
            <img
              src="https://img.freepik.com/premium-photo/vertical-background-image-minimal-home-office-workplace-with-laptop-accessories-black-white-copy-space_236854-27485.jpg?w=360"
              alt="Login image" class="w-100 vh-100" style="width: 200px; height: auto;">
          </div>
        </div>
      </div>
    </section>