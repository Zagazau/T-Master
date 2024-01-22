<?php
require_once __DIR__ . '/infra/middlewares/middleware-not-authenticated.php';
//require_once __DIR__ . '/tmaster/infra/db/setupdatabase.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="assets/css/styles.css">
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
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid d-flex justify-content-between">
      <div class="w-100 d-flex justify-content-between align-items-center">
        <a href="/" class="navbar-brand d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
          <img class="header-logo" src="assets/images/Logo1.png" alt="">
        </a>
        <button class="navbar-toggler ml-auto custom-toggler" type="button" data-toggle="collapse"
          data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
          aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
      <div class="collapse navbar-collapse text-center" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a href="#homepage" class="nav-link px-2 link-secondary" style="color: gray;">Home</a>
          </li>
          <li class="nav-item">
            <a href="#about" class="nav-link px-2 link-dark" style="color: gray;">About</a>
          </li>
          <li class="nav-item">
            <a href="#services" class="nav-link px-2 link-dark" style="color: gray;">Serviços</a>
          </li>
          <li class="nav-item">
            <a href="#contact" class="nav-link px-2 link-dark" style="color: gray;">Contacto</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-outline-secondary ml-2 mb-2" href="./pages/public/signin.php" style="width: 90%;">

              Login
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <main>
    <div class="container">
      <section id="homepage">
        <img src="assets/images/background2.png" class="hero__background-img" alt="">
        <header class="masthead">
          <div class="container px-4 px-lg-5 h-100">
            <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
              <div class="col-lg-8 align-self-end">
                <h1 class="text-dark mb-5 display-4">T-MASTER</h1>
                <hr class="my-4">
              </div>
              <div class="col-lg-8 align-self-baseline">
                <p class="font-weight-normal lead mb-4">Transforma o caos em clareza! Com o T-Master poderás
                  categorizar,
                  priorizar e partilhar as tuas tarefas. Define Estados, destaca as tuas tarefas favoritas e simplifica
                  a gestão do teu tempo.</p>
                <a class="btn btn-info btn-xl" href="./pages/public/signup.php">Cria Conta</a>
              </div>
            </div>
          </div>
        </header>
      </section>

      <section id="about">
        <div class="container-fluid align-items-center">
          <div class="row">
            <div class="col-md-12 col-lg-6">
              <div>
                <div class="mt-5 image-container">
                  <img src="assets/images/aboutU.jpg" class="img-fluid" alt="Responsive Image">
                </div>
              </div>
            </div>

            <div class="col-md-12 col-lg-6 py-5">
              <div class="media-content">
                <h1 class="text-right font-weight-bold text-dark pb-3 display-2">Sobre nós</h1>
                <div class="text-right text-dark pb-3">
                  <p class="font-weight-normal lead mb-4">
                    Bem-vindo ao T-Master, a tua solução completa para gestão de tarefas de forma eficiente e intuitiva!
                    Na nossa jornada para simplificar a tua vida profissional e pessoal, oferecemos uma plataforma
                    robusta que permite aos utilizadores organizarem tarefas, definirem prioridades e colaborarem de
                    forma eficaz. <br> Junta-te a nós e otimiza a tua produtividade!
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section id="services">
        <div class="container px-8 px-lg-5">
          <h2 class="text-center mt-0">Serviços</h2>
          <hr>
          <div class="row gx-4 gx-lg-5">
            <div class="col-lg-3 col-md-6 text-center">
              <div class="mt-5">
                <div class="mb-2"><i class="bi-gem fs-1 text-primary"></i></div>
                <h3 class="h4 mb-2">Priorizar Tarefas</h3>
                <p class="text-muted mb-0">Poderás priorizar as tuas tarefas de modo a aumentar a tua
                  produtividade e
                  atingires os teus objetivos com facilidade.</p>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
              <div class="mt-5">
                <div class="mb-2"><i class="bi bi-share text-primary"></i></div>
                <h3 class="h4 mb-2">Partilhar </h3>
                <p class="text-muted mb-0">Conseguirás partilhar as tuas tarefas, e acompanhar em tempo real as tarefas
                  de outros utilizadores. </p>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
              <div class="mt-5">
                <div class="mb-2"><i class="bi bi-calendar text-primary"></i></div>
                <h3 class="h4 mb-2"> Calendarizar</h3>
                <p class="text-muted mb-0">Serás capaz de calendarizar as tuas tarefas e fazer um planeamento a longo
                  prazo das tuas funções. </p>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
              <div class="mt-5">
                <div class="mb-2"><i class="bi bi-heart-fill text-primary"></i></div>
                <h3 class="h4 mb-2">Tarefas Favoritas</h3>
                <p class="text-muted mb-0">Terás o poder de favoritar as tuas tarefas, o que te ajudará a concentrares
                  nas tarefas mais relevantes.</p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section id="contact">
        <div class="container">
          <div class="row">
            <div class="col-md-5 mr-auto">
              <h2>Contactos</h2>
              <hr>
              <p class="fs-4 contactos"> <i class="bi bi-telephone-fill"></i> 123456789</p>
              <p class="fs-4 contactos"><i class="bi bi-envelope-fill"></i> tmaster@tmaster.pt</p>
            </div>

            <div class="col-md-6">
              <form class="mb-5">
                <div class="row">
                  <div class="col-md-12 form-group">
                    <label class="col-form-label">Nome</label>
                    <input type="text" class="form-control">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 form-group">
                    <label class="col-form-label">E-mail</label>
                    <input type="text" class="form-control">
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12 form-group">
                    <label class="col-form-label">Mensagem</label>
                    <input type="text" class="form-control" maxlength="250">
                  </div>
                </div>

                <button type="submit" class="btn btn-primary">Enviar</button>
              </form>
            </div>
          </div>
        </div>
      </section>

      <hr>

      <section class="social mt-5 mb-4 text-center">
        <div class="container">
          <div class="row justify-content-center">
            <a href="https://www.instagram.com/" target="_blank" class="insta col-2"><i class="bi bi-instagram"></i></a>
            <a href="https://www.facebook.com/" target="_blank" class="facebook col-2"><i
                class="bi bi-facebook"></i></a>
            <a href="https://www.linkedin.com/" target="_blank" class="linkedin col-2"><i
                class="bi bi-linkedin"></i></a>
            <a href="https://twitter.com/" target="_blank" class="twitter col-2"><i class="bi bi-twitter"></i></a>
          </div>
        </div>
      </section>

</body>

</html>