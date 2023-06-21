<?php

use Core\App;
use Core\Database;
use Core\Validator;
use Core\Authenticator;

$db = App::resolve(Database::class);

$email = $_POST['email'];
$password = $_POST['password'];

$errors = [];
if (!Validator::email($email)) {
   $errors['email'] = 'Por favor, introduce un correo válido.';
}

if (!Validator::string($password, 7, 255)) {
    $errors['password'] = 'Por favor, introduce una contraseña de al menos 7 caracteres.';
}

if (!empty($errors)) {
    return view('registration/create.view.php', [
        'errors' => $errors
    ]);
}

$user = $db->query('select * from USUARIO where email = :email', [
    'email' => $email
])->find();

$userID = $db->query('select * from USUARIO where id = :id', [
    'id' => $id
])->find();

if ($user) {
    header('location: /');
    exit();    
} else {
    $db->query('INSERT INTO USUARIO(email, password) VALUES(:email, :password)', [
        'email' => $email,
        'password' => password_hash($password, PASSWORD_BCRYPT)
    ]);

    $authenticator = new Authenticator();
    $authenticator->login($user);
    header('location: /');
    exit();
}