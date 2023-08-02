<?php
use Core\App;
use Core\Validator;
use Core\Database;
echo "controller/usuarios/store.php";

$db = App::resolve(Database::class);
$errors = [];

if (! Validator::string($_POST['body'], 1, 1000)) {
    $errors['body'] = 'Un texto de no más de 1.000 caracteres es necesario.';
}

if (! empty($errors)) {
    return view("usuarios/create.view.php", [
        'heading' => 'Crear usuario',
        'errors' => $errors
    ]);
}

$datos = [(string)$_POST['nombre'], (string)$_POST['apellido'], (string)$_POST['email'], (string)$_POST['password'], (string)$_POST['rol']];
generarConsultaInsert('USUARIO', $datos);

header('location: /');
die();
