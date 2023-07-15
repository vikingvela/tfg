<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);


$currentUser = array('email' => $_SESSION['user']['email']);
$currentUserId = getUsuarioIDbyEmail($currentUser['email']);

/*
$liga = $db->query('select * from USUARIO where id = :id', [
    'id' => $_GET['id']
])->findOrFail();
*/

//authorize($usuario['user_id'] === $currentUserId);

view("usuarios/edit.view.php", [
    'heading' => 'Editar usuario',
    'errors' => [],
    'usuario' => $currentUserId
]);