<?php

use Core\App;
use Core\Authenticator;
use Core\Database;
use Http\Forms\LoginForm;

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

$estado = App::resolve(Database::class)->query('select ESTADO from USUARIO where email = :email', ['email' => $_POST['email']])->find();
switch ($estado["ESTADO"]) {    
    case 0; // Usuario inactivo
        $form->error(
            'email', 'Usuario inactivo.'
        )->throw();
        break; 
    case 1; // Usuario activo pero sin datos completados
        redirect('/usuario/edit');
        break;
    default; // Usuario activo y con datos completados
        echo "Usuario activo y con datos completados";    
        redirect('/');
        break;
}