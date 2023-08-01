<?php

use Core\App;
use Core\Authenticator;
use Core\Database;
use Http\Forms\LoginForm;

$db = App::resolve(Database::class);

$currentUser = array('email' => $_SESSION['usuario']['email']);
$currentUserId = getUsuarioIDbyEmail($currentUser['email']);

view("usuarios/edit.view.php", [
    'heading' => 'Editar usuario',
    'errors' => [],
    'usuario' => $currentUserId
]);