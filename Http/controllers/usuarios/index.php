<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);
$usuarios = $db->query('select * from USUARIO')->get();

view("usuarios/index.view.php", [
    'heading' => 'Usuarios',
    'Usuarios' => $usuarios
]);