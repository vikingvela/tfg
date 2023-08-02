<?php

use Core\App;
use Core\Validator;
use Core\Database;
$db = App::resolve(Database::class);
$errors = [];

// Validar formulario
if (! Validator::string($_POST['nombre'], 1, 255)) {
    $errors['nombre'] = 'Un nombre de no más de 255 caracteres es necesario.';
}
if (! Validator::string($_POST['descripcion'], 1, 255)) {
    $errors['descripcion'] = 'Una descripción de no más de 255 caracteres es necesario.';
}
if (!(date_create($_POST['fecha_fin']) > date_create($_POST['fecha_inicio']))) {
    $errors['fecha'] = 'La fecha de fin no puede ser anterior a la fecha de inicio.';
}
// Validar que el nombre no se encuentra repetido
$existe = $db->query('SELECT nombre FROM LIGA WHERE nombre = :nombre', [
    'nombre' => $_POST['nombre']
])->find();

if ($existe) {
    $errors['nombre'] = 'Este nombre ya se encuentra registrado.';
}

if (! empty($errors)) {
    return view("ligas/create", [
        'heading' => 'Crear Liga',
        'errors' => $errors
    ]);
}
// Si no hay errores, insertar en BD
$datos = array(
    'nombre' => $_POST['nombre'],
    'descripcion' => $_POST['descripcion'],
    'deporte_id' => $_POST['deporte'],
    'creado_por' => getUsuarioIDbyEmail($_SESSION['usuario']['email'])
);

if(isset($_POST['fecha_inicio'])) $datos['fecha_inicio'] = $_POST['fecha_inicio'];
if(isset($_POST['fecha_fin'])) $datos['fecha_fin'] = $_POST['fecha_fin'];

$db->insert('LIGA', $datos);

header('location: /ligas');
die();