<?php

use Core\App;
use Core\Authenticator;
use Core\Database;
use Http\Forms\LoginForm;

$db = App::resolve(Database::class);

$form = LoginForm::validate($attributes = [
    'email' => $_POST['email'],
    'password' => $_POST['password']
]);

$signedIn = (new Authenticator)->attempt(
    $attributes['email'], $attributes['password']
);

if (!$signedIn) {
    $form->error(
        'email', 'Ninguna cuenta encontrada para ese correo y contraseña.'
    )->throw();
}

$usuario = $db->query('select * from USUARIO where email = :email', ['email' => $_POST['email']])->findOrFail();
$db->updateID('usuario', $usuario['id'], array('ultima_sesion' => date("Y-m-d H:i:s")));


switch ($usuario['estado']) {    
    case 0; // Usuario inactivo
        $form->error(
            'email', 'Usuario inactivo.'
        )->throw();
        break; 
    case 1; // Usuario activo pero sin datos completados
        redirect('/usuarios/edit?id=' . $usuario['id']);
        break;
    default; // Usuario activo y con datos completados
        echo "Usuario activo y con datos completados";    
        redirect('/');
        break;
}