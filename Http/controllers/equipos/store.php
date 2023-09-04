<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);
$errors = [];


// Validar los campos de entrada
if (! Validator::string($_POST['nombre'], 1, 45)) {
    $errors['nombre'] = 'Un nombre de no más de 45 caracteres es necesario.';
}
if(!empty($_POST['descripcion'])){
    if (! Validator::string($_POST['descripcion'], 1, 255)) {
        $errors['descripcion'] = 'Una descripción de no más de 255 caracteres es necesario.';
    }
}
// Validar que el nombre no se encuentra repetido
$existe = $db->query('SELECT nombre FROM equipo WHERE nombre = :nombre', [
    'nombre' => $_POST['nombre']
])->find();

if ($existe) {
    $errors['nombre'] = 'Este nombre ya se encuentra registrado.';
}

// Validar que el archivo sea una imagen
$nombreArchivo = $_FILES["escudo"]["name"];
$rutaTemporal = $_FILES["escudo"]["tmp_name"];

// Define el tamaño máximo en 10MB
$tamanoMaximoMB = 10;

// Define las dimensiones máximas (ancho x alto en píxeles)
$anchoMaximo = 600;
$altoMaximo = 600;

// Verifica el tamaño en MB
if ($_FILES["escudo"]["size"] / (1024 * 1024) > $tamanoMaximoMB) {
    $errors['escudo'] = "Error: La imagen es demasiado grande (máximo $tamanoMaximoMB MB).";
} else {
    // Verifica las dimensiones en píxeles
    list($ancho, $alto) = getimagesize($rutaTemporal);
    if ($ancho > $anchoMaximo || $alto > $altoMaximo) {
        $errors['escudo'] = "Error: Las dimensiones de la imagen son demasiado grandes (máximo $anchoMaximo x $altoMaximo píxeles).";
    } 
}
$carpetaDestino = "uploads/";
    
// Validar errores
if (! empty($errors)) {
    return view("equipos/create.view.php", [
        'heading' => 'Crear equipo',
        'errors' => $errors
    ]);
}

// Si no hay errores, insertar en BD
$datos = array(
    'nombre' => $_POST['nombre'],
    'creado_por' => getUsuarioIDbyEmail($_SESSION['usuario']['email']),
    'fecha_creacion' => date('Y-m-d H:i:s')
);

if(isset($_POST['logo'])) $datos['logo'] = $_POST['logo'];
if(isset($_POST['cover'])) $datos['cover'] = $_POST['cover'];
if(isset($_POST['descripcion'])) $datos['descripcion'] = $_POST['descripcion'];

$db->insert('equipo', $datos);

header('location: /equipos');
die();