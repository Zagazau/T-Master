<?php
require_once __DIR__ . '../../db/connection.php';

function createUser($user)
{
    $user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);
    $sqlCreate = "INSERT INTO 
    utilizadores (
        username, 
        password, 
        nome, 
        email) 
    VALUES (
        :username, 
        :password, 
        :nome, 
        :email
    )";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlCreate);

    $success = $PDOStatement->execute([
        ':username' => $user['username'],
        ':password' => $user['password'],
        ':nome' => $user['nome'],
        ':email' => $user['email'],
    ]);

    if ($success) {
        $user['id'] = $GLOBALS['pdo']->lastInsertId();
    }
    return $success;
}

function getById($id)
{
    $PDOStatement = $GLOBALS['pdo']->prepare('SELECT * FROM utilizadores WHERE id = ?;');
    $PDOStatement->bindValue(1, $id, PDO::PARAM_INT);
    $PDOStatement->execute();
    return $PDOStatement->fetch();
}

function getByEmail($email)
{
    $PDOStatement = $GLOBALS['pdo']->prepare('SELECT * FROM utilizadores WHERE email = ? LIMIT 1;');
    $PDOStatement->bindValue(1, $email);
    $PDOStatement->execute();
    return $PDOStatement->fetch();
}

function getAll()
{
    $PDOStatement = $GLOBALS['pdo']->query('SELECT * FROM utilizadores;');
    $users = [];
    while ($listaDeusers = $PDOStatement->fetch()) {
        $users[] = $listaDeusers;
    }
    return $users;
}

function updateUser($user)
{
    if (isset($user['password']) && !empty($user['password'])) {
        $user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);

        $sqlUpdate = "UPDATE  
        utilizadores SET
            username = :username, 
            password = :password, 
            nome = :nome, 
            email = :email,
            foto_perfil = :foto_perfil
        WHERE id = :id;";

        $PDOStatement = $GLOBALS['pdo']->prepare($sqlUpdate);

        return $PDOStatement->execute([
            ':id' => $user['id'],
            ':username' => $user['username'],
            ':password' => $user['password'],
            ':nome' => $user['nome'],
            ':email' => $user['email'],
            ':foto_perfil' => $user['foto_perfil'],
        ]);
    }

    $sqlUpdate = "UPDATE  
    utilizadores SET
        username = :username, 
        nome = :nome, 
        email = :email,
        foto_perfil = :foto_perfil
    WHERE id = :id;";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlUpdate);

    return $PDOStatement->execute([
        ':id' => $user['id'],
        ':username' => $user['username'],
        ':nome' => $user['nome'],
        ':email' => $user['email'],
        ':foto_perfil' => $user['foto_perfil'],
    ]);
}


function updatePassword($user)
{
    if (isset($user['password']) && !empty($user['password'])) {
        $user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);

        $sqlUpdate = "UPDATE  
        utilizadores SET
            username = :username, 
            password = :password
        WHERE id = :id;";

        $PDOStatement = $GLOBALS['pdo']->prepare($sqlUpdate);

        return $PDOStatement->execute([
            ':id' => $user['id'],
            ':username' => $user['username'],
            ':password' => $user['password'],
        ]);
    }
}

function deleteUser($id)
{
    $PDOStatement = $GLOBALS['pdo']->prepare('DELETE FROM utilizadores WHERE id = ?;');
    $PDOStatement->bindValue(1, $id, PDO::PARAM_INT);
    return $PDOStatement->execute();
}

function createNewUser($user)
{
    $user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);
    $sqlCreate = "INSERT INTO 
    utilizadores (
        username, 
        email,
        nome, 
        password) 
    VALUES (
        :username, 
        :email, 
        :nome, 
        :password
    )";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlCreate);
    $success = $PDOStatement->execute([
        ':username' => $user['username'],
        ':email' => $user['email'],
        ':nome' => $user['nome'],
        ':password' => $user['password'],
    ]);

    if ($success) {
        $user['id'] = $GLOBALS['pdo']->lastInsertId();
        return $user;
    }

    return false;
}
