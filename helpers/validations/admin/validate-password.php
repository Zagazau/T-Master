<?php

function passwordIsValid($req)
{
    foreach ($req as $key => $value) {
        $req[$key] = trim($req[$key]);
    }

    if (empty($req['name']) || strlen($req['name']) < 3 || strlen($req['name']) > 255) {
        $errors['name'] = 'O nome não pode estar vazio e deve de conter entre 3 e 255 caracteres.';
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

    return $req;
}

?>