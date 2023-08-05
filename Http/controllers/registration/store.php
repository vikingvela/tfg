<?php

use Core\App;
use Core\Database;
use Core\Validator;
use Core\Authenticator;

$db = App::resolve(Database::class);

echo "registration/store.php";

$email = $_POST['email'];
$password = $_POST['password'];

$errors = [];
if (!Validator::email($email)) {
   $errors['email'] = 'Por favor, introduce un correo válido.';
}

if (!Validator::string($password, 7, 255)) {
    $errors['password'] = 'Por favor, introduce una contraseña de al menos 7 caracteres.';
}

$user = $db->query('select * from USUARIO where email = :email', [
    'email' => $email
])->find();

if ($user) {
    $errors['usuario'] = 'Correo ya registrado.';
} else {
    $db->insert('USUARIO', [
        'email' => $email, 
        'password' => password_hash($password, PASSWORD_BCRYPT),
        'fecha_alta' => date('Y-m-d H:i:s')
    ]);

    $authenticator = new Authenticator();
    $authenticator->login($user);
    header('location: /');
    exit();
}

if (!empty($errors)) {
    return view('registration/create.view.php', [
        'errors' => $errors
    ]);
}

