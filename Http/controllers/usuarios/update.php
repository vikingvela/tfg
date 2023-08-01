<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

// Encontrar la liga correspondiente al id
$usuario = $db->query('select * from USUARIO where id = :id', [
    'id' => $_POST['id']
])->findOrFail();

// Autoriza que el usuario actual puede editar
authorize($_POST['modificado_por'] === $_POST['id'] || $_POST['modificado_por'] > 10);

// Validar el formulario
$errors = [];

if (! Validator::string($_POST['nombre'], 1, 25)) {
    $errors['nombre'] = 'Un nombre de no más de 25 caracteres es necesario.';
}
if (! Validator::string($_POST['apellido'], 1, 50)) {
    $errors['apellido'] = 'Un apellido de no más de 50 caracteres es necesario.';
}

// Si no hay errores en la validación, actualizar la tabla de usuarios
if (count($errors)) {
    return view('usuarios/edit.view.php', [
        'heading' => 'Editar usuarios',
        'errors' => $errors,
        'usuario' => $usuario
    ]);
}
$db->update('usuario', [
    'nombre' => $_POST['nombre'],
    'apellido' => $_POST['apellido'],
    'modificado_por' => $_POST['modificado_por']
]);
/*
$db->query('update usuarios set body = :body where id = :id', [
    'id' => $_POST['id'],
    'body' => $_POST['body']
]);
*/
// Redirige al usuario
header('location: /usuarios');
die();
