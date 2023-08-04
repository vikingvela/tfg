<?php

use Core\App;
use Core\Database;
use Core\Validator;

echo "ligas/update.php";

$db = App::resolve(Database::class);
$errors = [];

// Encontrar la liga correspondiente al id
$liga = $db->query('SELECT * from LIGA where id = :id', [
    'id' => $_POST['id']
])->findOrFail();

// Mostrar todos los deportes disponibles
$deportes_disponibles = $db->query('SELECT * from deporte')->get();

// Autoriza que el usuario actual puede editar la liga
$usuario = getUsuarioIDbyEmail($_SESSION['usuario']['email']);
if(!authorize($liga['creado_por'] ===  $usuario || isAdmin($usuario))) 
    $errors['autorizacion'] = 'No tienes autorización para editar esta liga.'; 

// Validar el formulario
if (!Validator::string($_POST['nombre'], 1, 50)) {
    $errors['nombre'] = 'Un nombre de no más de 50 caracteres es necesario.';
}
if (!Validator::string($_POST['descripcion'], 1, 255)) {
    $errors['descripcion'] = 'Una descripción de no más de 255 caracteres es necesaria.';
}
if(!Validator::fecha($_POST['fecha_inicio'])) {
    $errors['fecha_inicio'] = 'La fecha de inicio no es válida.';
}
if(!Validator::fecha($_POST['fecha_fin'])) {
    $errors['fecha_fin'] = 'La fecha de fin no es válida.';
}
if (!(date_create($_POST['fecha_fin']) > date_create($_POST['fecha_inicio']))) {
    $errors['fecha'] = 'La fecha de fin no puede ser anterior a la fecha de inicio.';
}

// FALTA VALIDAR EL LOGO Y LA PORTADA

// Validar que el nombre no se encuentra repetido
$existe = $db->query('SELECT nombre FROM LIGA WHERE nombre = :nombre AND id != :id', [
    'nombre' => $_POST['nombre'],
    'id' => $_POST['id']
])->find();
if ($existe) {
    $errors['nombre'] = 'Este nombre ya se encuentra registrado.';
}


// Si no hay errores en la validación, actualizar la tabla de ligas
if (!empty($errors)) {
    return view('ligas/edit.view.php', [
        'heading' => 'Editar liga',
        'errors' => $errors,
        'deportes_disponibles' => $deportes_disponibles,
        'liga' => $liga
    ]);
}

$datos = array(
    'nombre' => $_POST['nombre'],
    'descripcion' => $_POST['descripcion'],
    'deporte_id' => $_POST['deporte'],
    'modificado_por' => getUsuarioIDbyEmail($_SESSION['usuario']['email']),
    'fecha_inicio' => $_POST['fecha_inicio'],
    'fecha_fin' => $_POST['fecha_fin']
);
$db->updateID('LIGA', $_POST['id'], $datos);


// Redirige al usuario
header('location: /ligas');
die();
