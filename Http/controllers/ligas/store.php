<?php

use Core\App;
use Core\Validator;
use Core\Database;

$db = App::resolve(Database::class);
$errors = [];

// Validar formulario
if (! Validator::string($_POST['nombre'], 1, 50)) {
    $errors['nombre'] = 'Un nombre de no más de 50 caracteres es necesario.';
}
if (! Validator::string($_POST['descripcion'], 1, 255)) {
    $errors['descripcion'] = 'Una descripción de no más de 255 caracteres es necesario.';
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
// Validar que el nombre no se encuentra repetido
$existe = $db->query('SELECT nombre FROM LIGA WHERE nombre = :nombre AND id != :id', [
    'nombre' => $_POST['nombre'],
    'id' => $_POST['id']
])->find();

if ($existe) {
    $errors['nombre'] = 'Este nombre ya se encuentra registrado.';
}


// Validar que el archivo sea una imagen
$nombreArchivo = $_FILES["logo"]["name"];
$rutaTemporal = $_FILES["logo"]["tmp_name"];

// Define el tamaño máximo en 10MB
$tamanoMaximoMB = 10;

// Define las dimensiones máximas (ancho x alto en píxeles)
$anchoMaximo = 600;
$altoMaximo = 600;

// Verifica el tamaño en MB
if ($_FILES["logo"]["size"] / (1024 * 1024) > $tamanoMaximoMB) {
    $errors['logo'] = "Error: La imagen es demasiado grande (máximo $tamanoMaximoMB MB).";
} else {
    // Verifica las dimensiones en píxeles
    list($ancho, $alto) = getimagesize($rutaTemporal);
    if ($ancho > $anchoMaximo || $alto > $altoMaximo) {
        $errors['logo'] = "Error: Las dimensiones de la imagen son demasiado grandes (máximo $anchoMaximo x $altoMaximo píxeles).";
    } 
}

if (!empty($errors)) {
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
$db->insert('LIGA_USUARIO', [
    'liga_id' => $db->lastInsertId(),
    'usuario_id' => getUsuarioIDbyEmail($_SESSION['usuario']['email']),
    'deporte' => 'deporte'
]);

header('location: /ligas');
die();