<?php

function validatedUser($req)
{
    foreach ($req as $key => $value) {
        $req[$key] = trim($req[$key]);
    }

    if (empty($req['nome']) || strlen($req['nome']) < 3 || strlen($req['nome']) > 255) {
        $errors['nome'] = 'O nome não pode estar vazio e deve de conter entre 3 e 255 caracteres.';
    }

    if (empty($req['username']) || strlen($req['username']) < 3 || strlen($req['username']) > 255) {
        $errors['username'] = 'O username não pode estar vazio e deve de conter entre 3 e 255 caracteres.';
    }

    if (!filter_var($req['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'O email não pode estar vazio e tem de ter um formato do tipo nome@exemplo.com.';
    }

    if (getByEmail($req['email'])) {
        $errors['email'] = 'Email já existente.';
        return ['invalid' => $errors];
    }

    if (!empty($req['password']) && strlen($req['password']) < 6) {
        $errors['password'] = 'A password não pode estar vazia e deve conter no mínimo 6 caracteres.';
    }

    if (!empty($req['confirm_password']) && ($req['confirm_password']) != $req['password']) {
        $errors['confirm_password'] = 'The Confirm Password field must not be empty and must be the same as the Password field.';
    }

    if (isset($errors)) {
        return ['invalid' => $errors];
    }

    $req['password'] = password_hash($req['password'], PASSWORD_DEFAULT);

    return $req;
}
?>