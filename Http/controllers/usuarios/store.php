<?php
use Core\App;
use Core\Validator;
use Core\Database;
echo "usuarios/store.php";

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

$db->insert('USUARIO',[
    'nombre'=>$_POST['nombre'], 
    'apellido'=>$_POST['apellido'], 
    'email'=>$_POST['email'], 
    'password'=>password_hash($_POST['password'], PASSWORD_BCRYPT),
    'fecha_alta'=>date('Y-m-d H:i:s')
]);

header('location: /');
die();