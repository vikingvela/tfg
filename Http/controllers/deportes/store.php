<?php

use Core\App;
use Core\Validator;
use Core\Database;

$db = App::resolve(Database::class);

$nombre = $_POST['nombre'];
if (isset($_POST['logo']) ? $logo = $_POST['logo'] : $logo = null);
if (isset($_POST['cover']) ? $cover = $_POST['cover'] : $cover = null);
$creado_por = getUsuarioIDbyEmail($_POST['usuario']);
echo 'sesion';
dd($creado_por);
echo 'sesion';

$errors = [];

// Validar los campos de entrada
if (! Validator::string($_POST['nombre'], 1, 45)) {
    $errors['body'] = 'Un nombre de no más de 45 caracteres es necesario.';
}

if (! empty($errors)) {
    return view("deportes/create.view.php", [
        'heading' => 'Crear Deporte',
        'errors' => $errors
    ]);
}

// Validar que el nombre no se encuentra repetido
$deporte = $db->query('select * from DEPORTE where nombre = :nombre', [
    'nombre' => $nombre
])->find();

if ($deporte) {
    header('location: /');
    exit();    
} else {
    // Insertar en BD
}

header('location: /deportes');
die();