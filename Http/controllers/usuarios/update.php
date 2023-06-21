<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$currentUserId = 222221;

// Encontrar la liga correspondiente al id
$liga = $db->query('select * from USUARIO where id = :id', [
    'id' => $_POST['id']
])->findOrFail();

// Autoriza que el usuario actual puede editar la liga
authorize($usuario['user_id'] === $currentUserId);

// Validar el formulario
$errors = [];

if (! Validator::string($_POST['body'], 1, 10)) {
    $errors['body'] = 'Un texto de no más de 1.000 caracteres es necesario.';
}

// Si no hay errores en la validación, actualizar la tabla de ligas
if (count($errors)) {
    return view('usuarios/edit.view.php', [
        'heading' => 'Editar usuarios',
        'errors' => $errors,
        'usuario' => $usuario
    ]);
}

$db->query('update usuarios set body = :body where id = :id', [
    'id' => $_POST['id'],
    'body' => $_POST['body']
]);

// Redirige al usuario
header('location: /usuarios');
die();
