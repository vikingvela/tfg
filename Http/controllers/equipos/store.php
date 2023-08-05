<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);
$errors = [];

echo "equipos/store.php";

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

try {
    // Inicia la transacción
    $db->beginTransaction();

    // Realiza la inserción del equipo en la base de datos y guarda los datos en $equipo
    $db->insert('equipo', $datos);

    // Obtiene el ID del equipo recién registrado
    $equipo_id = $db->lastInsertId();

    // Finaliza la transacción
    $db->commit();

    // Redirige a la página de edición del equipo usando el ID del equipo
    header("Location: /equipos/edit.php?id=" . $equipo_id); 
    exit;
} catch (Exception $e) {
    // Si ocurre un error, deshace la transacción para revertir la inserción
    $db->rollBack();
    // Maneja el error de alguna manera, por ejemplo, mostrando un mensaje de error al usuario
}

header('location: /equipos');
die();