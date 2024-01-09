<?php
$title = '- Sign In';
require_once __DIR__ . '/../../infra/middlewares/middleware-not-authenticated.php';
?>

<body>
    <div class="min-h-screen d-flex flex-column justify-content-center items-center pt-6 sm:pt-0 bg-gray-100">
        <section class="bg-image bg-cover bg-p-center bg-no-repeat vh-100 position-relative">
            <div class="container py-3 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-dark text-white rounded-4 bg-opacity-75">
                            <div class="card-body p-3 text-center">

                                <div class="mb-md-3 mt-md-2 pb-3">
                                    <a href="">
                                        <img src="">
                                    </a>

                                    <form action="/tmaster/controllers/auth/signin.php" method="post" class="p-4">
                                        <div class="form-outline mb-4">
                                            <input type="email" id="form3Example3cg"
                                                class="form-control form-control-lg" placeholder="Email" name="email"
                                                id="email" />
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="password" id="form3Example4cg"
                                                class="form-control form-control-lg" placeholder="Password"
                                                name="password" id="password" />
                                        </div>

                                        <div class="form-check mb-5 text-center">
                                            <div>
                                                <input class="form-check-input me-2" type="checkbox" value=""
                                                    id="form2Example3cg" />
                                                <label class="form-check-label text-center" for="form2Example3cg">
                                                    Guardar dados
                                                </label>
                                            </div>
                                        </div>
                                        <?php
                    if (isset($_SESSION['errors']) && is_array($_SESSION['errors'])) {
                      foreach ($_SESSION['errors'] as $error) {
                        echo '<p class="alert" style="color: red;">' . $error . '</p>';
                      }
                      unset($_SESSION['errors']);
                    }
                    ?>
                                        <button class="btn btn-outline-light btn-lg px-4 mt-3" type="submit" name="user"
                                            value="login">Login</button>

                                        <div class="mt-2">
                                            <p>Ainda não tem conta?<a href="/tmaster/pages/public/signup.php"
                                                    class="text-white-50 fw-bold ms-2">Registe-se agora!</a></p>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>

</html>