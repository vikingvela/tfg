<?php

use Core\App;
use Core\Database;

echo "equipos/edit.php";

$db = App::resolve(Database::class);

// EQUIPO
$equipo = $db->query('SELECT * from equipo where id = :id', [
    'id' => $_GET['id']
])->findOrFail();


view("equipos/edit.view.php", [
    'heading' => 'Editar equipo',
    'errors' => [],
    'equipo' => $equipo
]);