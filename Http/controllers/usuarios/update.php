<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);
$errors = [];

// Encontrar el usuario correspondiente al id
$usuario = $db->query('select * from USUARIO where id = :id', [
    'id' => $_POST['id']
])->findOrFail();

// Autoriza que el usuario actual puede editar el usuario
if(!authorize($usuario['email'] === $_SESSION['usuario']['email'] || isAdmin($usuario)))
    $errors['autorizacion'] = 'No tienes autorización para editar este usuario.'; 

// Validar el formulario
if (! Validator::string($_POST['nombre'], 1, 25)) {
    $errors['nombre'] = 'Un nombre de no más de 25 caracteres es necesario.';
}
if (! Validator::string($_POST['apellido'], 1, 50)) {
    $errors['apellido'] = 'Un apellido de no más de 50 caracteres es necesario.';
}

// Validar que el archivo sea una imagen
$nombreArchivo = $_FILES["foto"]["name"];
$rutaTemporal = $_FILES["foto"]["tmp_name"];

// Define el tamaño máximo en 10MB
$tamanoMaximoMB = 10;

// Define las dimensiones máximas (ancho x alto en píxeles)
$anchoMaximo = 600;
$altoMaximo = 600;

// Verifica el tamaño en MB
if ($_FILES["foto"]["size"] / (1024 * 1024) > $tamanoMaximoMB) {
    $errors['foto'] = "Error: La imagen es demasiado grande (máximo $tamanoMaximoMB MB).";
} else {
    // Verifica las dimensiones en píxeles
    list($ancho, $alto) = getimagesize($rutaTemporal);
    if ($ancho > $anchoMaximo || $alto > $altoMaximo) {
        $errors['foto'] = "Error: Las dimensiones de la imagen son demasiado grandes (máximo $anchoMaximo x $altoMaximo píxeles).";
    } 
}

// Si no hay errores en la validación, actualizar la tabla de usuarios
if (count($errors)) {
    return view('usuarios/edit.view.php', [
        'heading' => 'Editar usuarios',
        'errors' => $errors,
        'usuario' => $usuario
    ]);
}

$datos = array(
    'nombre' => $_POST['nombre'],
    'apellido' => $_POST['apellido'],
    'modificado_por' => getUsuarioIDbyEmail($_SESSION['usuario']['email']),
    'fecha_mod' => date('Y-m-d H:i:s')
);

if($usuario['estado'] < 2) $datos['estado'] = 2;

$db->updateID('usuario',$_POST['id'], $datos);


// Redireccionar a la página de inicio
header('location: /');
die();