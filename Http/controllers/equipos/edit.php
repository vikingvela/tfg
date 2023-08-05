<?php

use Core\App;
use Core\Database;

echo "equipos/edit.php";

$db = App::resolve(Database::class);

// Encontrar el equipo correspondiente al id
$equipo = $db->query('SELECT * from equipo where id = :id', [
    'id' => $_GET['id']
])->findOrFail();

view("equipos/edit.view.php", [
    'heading' => 'Editar equipo',
    'errors' => [],
    'equipo' => $equipo
]);