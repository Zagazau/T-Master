<?php
session_start();

require_once __DIR__ . '/../../infra/repositories/userRepository.php';
require_once __DIR__ . '/../../helpers/validations/app/validate-sign-up.php';

if (isset($_POST['user'])) {
    if ($_POST['user'] == 'signUp') {
        signUp($_POST);
    }
}

function signUp($req)
{
    $data = isSignUpValid($req);

    if (isset($data['invalid'])) {
        $_SESSION['errors'] = $data['invalid'];
        $params = '?' . http_build_query($req);
        header('location: /tmaster/pages/public/signup.php' . $params);
    } else {
        $user = createNewUser($data);

        if ($user) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['nome'] = $user['nome'];

            setcookie("id", $data['id'], time() + (60 * 60 * 24 * 30), "/");
            setcookie("nome", $data['nome'], time() + (60 * 60 * 24 * 30), "/");
            header('location: /tmaster/');
        }
    }
}
?>

