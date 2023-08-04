<?php

use Core\App;
use Core\Database;
use Core\Validator;

echo "deportes/update.php";

$db = App::resolve(Database::class);
$errors = [];

// Encontrar la liga correspondiente al id
$deporte = $db->query('SELECT * from DEPORTE where id = :id', [
    'id' => $_POST['id']
])->findOrFail();


// Validar el formulario
if (! Validator::string($_POST['nombre'], 1, 45)) {
    $errors['nombre'] = 'Un nombre de no más de 45 caracteres es necesario.';
}

// Validar que el nombre no se encuentra repetido
$existe = $db->query('SELECT nombre FROM DEPORTE WHERE nombre = :nombre AND id != :id', [
    'nombre' => $_POST['nombre'],
    'id' => $_POST['id']
])->find();
if ($existe) {
    $errors['nombre'] = 'Este nombre ya se encuentra registrado.';
}

// Si no hay errores en la validación, actualizar la tabla de deportes
if (count($errors)) {
    return view('deportes/edit.view.php', [
        'heading' => 'Editar deporte',
        'errors' => $errors,
        'deporte' => $deporte
    ]);
}

$datos = array(
    'nombre' => $_POST['nombre'],
    'modificado_por' => getUsuarioIDbyEmail($_SESSION['usuario']['email']),
);
$db->updateID('DEPORTE', $_POST['id'], $datos);


// Redirige al usuario
header('location: /deportes');
die();
