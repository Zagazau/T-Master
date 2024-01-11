<?php

function isLoginValid($req)
{
    foreach ($req as $key => $value) {
        $req[$key] = trim($req[$key]);
    }

    if (!filter_var($req['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = ' O email deve ter um formato do tipo nome@exemplo.com';
    }

    if (empty($req['password']) || strlen($req['password']) < 6) {
        $errors['password'] = 'A password deve conter no mínimo 6 caracteres';
    }

    if (isset($errors)) {
        return ['invalid' => $errors];
    }

    return $req;
}

function isPasswordValid($req)
{
    if (!isset($_SESSION['id'])) {

        $user = getByEmail($req['email']);

        if (!$user) {
            $errors['email'] = 'Introduza um email ou password válida.';
        }

        if (!password_verify($req['password'], $user['password'])) {
            $errors['password'] = 'Introduza um email ou password válida..';
        }

        if (isset($errors)) {
            return ['invalid' => $errors];
        }

        return $user;
    }
}
