<?php

use Core\App;
use Core\Database;
echo "usuarios/index.php";

$db = App::resolve(Database::class);
$usuarios = $db->query('select * from USUARIO')->get();

view("usuarios/index.view.php", [
    'heading' => 'Usuarios',
    'usuarios' => $usuarios
]);