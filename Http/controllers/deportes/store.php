<?php

use Core\App;
use Core\Validator;
use Core\Database;

$db = App::resolve(Database::class);
$errors = [];

// Validar los campos de entrada
if (! Validator::string($_POST['nombre'], 1, 45)) {
    $errors['nombre'] = 'Un nombre de no más de 45 caracteres es necesario.';
} 

// Validar que el nombre no se encuentra repetido
$existe = $db->query('SELECT nombre FROM DEPORTE WHERE nombre = :nombre', [
    'nombre' => $_POST['nombre']
])->find();

if ($existe) {
    $errors['nombre'] = 'Este nombre ya se encuentra registrado.';
} 
    
// Validar errores
if (! empty($errors)) {
    return view("deportes/create.view.php", [
        'heading' => 'Crear Deporte',
        'errors' => $errors
    ]);
}

// Si no hay errores, insertar en BD
$datos = array(
    'nombre' => $_POST['nombre'],
    'creado_por' => getUsuarioIDbyEmail($_SESSION['usuario']['email'])
);
isset($_POST['logo']) ? $datos['logo'] = $_POST['logo'] : $datos['logo'] = null;
isset($_POST['cover']) ? $datos['cover'] = $_POST['cover'] : $datos['cover'] = null;

$db->insert('DEPORTE', $datos);

// Redireccionar a la página de inicio
header('location: /deportes');
die();