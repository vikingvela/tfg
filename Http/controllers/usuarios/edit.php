<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$currentUserId = 1;

$liga = $db->query('select * from USUARIO where id = :id', [
    'id' => $_GET['id']
])->findOrFail();

authorize($usuario['user_id'] === $currentUserId);

view("usuarios/edit.view.php", [
    'heading' => 'Editar usuario',
    'errors' => [],
    'usuario' => $usuario
]);