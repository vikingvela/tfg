<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);
$errors = [];

// Encontrar la liga correspondiente al id
$usuario = $db->query('select * from USUARIO where id = :id', [
    'id' => $_POST['id']
])->findOrFail();

// Autoriza que el usuario actual puede editar
if(!authorize(getUsuarioIDbyEmail($_SESSION['usuario']['email']) === $_POST['id'] || getUsuarioIDbyEmail($_SESSION['usuario']['email']) > 10)){
    $errors['autorizacion'] = 'No tienes autorización para editar este usuario.';
};

// Validar el formulario
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
$db->update('usuario', $_POST['id'],[
    'nombre' => $_POST['nombre'],
    'apellido' => $_POST['apellido'],
    'modificado_por' => getUsuarioIDbyEmail($_SESSION['usuario']['email']),
    'fecha_mod' => date('Y-m-d H:i:s')
]);

// Redireccionar a la página de inicio
header('location: /usuarios');
die();
