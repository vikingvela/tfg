<?php

use Core\App;
use Core\Validator;
use Core\Database;

$db = App::resolve(Database::class);
$errors = [];

if (! Validator::string($_POST['body'], 1, 1000)) {
    $errors['body'] = 'Un texto de no más de 1.000 caracteres es necesario.';
}

if (! empty($errors)) {
    return view("usuarios/create.view.php", [
        'heading' => 'Crear usuario',
        'errors' => $errors
    ]);
}

$db->query('INSERT INTO USUARIO(body, user_id) VALUES(:body, :user_id)', [
    'body' => $_POST['body'],
    'user_id' => 1
]);

header('location: /usuarios');
die();
