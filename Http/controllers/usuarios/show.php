<?php

use Core\App;
use Core\Database;
echo "usuarios/show.php";

$db = App::resolve(Database::class);

$usuario = $db->query('select * from USUARIO where id = :id', [
    'id' => $_GET['id']
])->findOrFail();
$currentUser = $_SESSION['usuario']['email'];

authorize($usuario['email'] === $currentUser || isAdmin($currentUser));

view("usuarios/show.view.php", [
    'heading' => 'usuario',
    'usuario' => $usuario
]);
