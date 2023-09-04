<?php

use Core\App;
use Core\Database;


$db = App::resolve(Database::class);

if ($_SESSION['usuario'] ?? false) :  {
    $usuarioActual = $db->query('select * from USUARIO where email = :email', [
        'email' => $_SESSION['usuario']['email']
    ])->findOrFail();
} endif;

$usuario = $db->query('SELECT * from usuario where id = :id', [
    'id' => $_GET['id']
])->findOrFail();

view("usuarios/edit.view.php", [
    'heading' => 'Editar usuario',
    'errors' => [],
    'usuarioActual' => $usuarioActual,
    'usuario' => $usuario
]);