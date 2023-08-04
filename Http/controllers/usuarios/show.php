<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$usuario = $db->query('select * from USUARIO where id = :id', [
    'id' => $_GET['id']
])->findOrFail();

authorize($usuario['user_id'] === $currentUserId);

view("usuarios/show.view.php", [
    'heading' => 'usuario',
    'usuario' => $usuario
]);
