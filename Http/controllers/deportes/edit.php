<?php

use Core\App;
use Core\Database;

echo "deportes/edit.php";

$db = App::resolve(Database::class);

// Encontrar el deporte correspondiente al id
$deporte = $db->query('SELECT * from DEPORTE where id = :id', [
    'id' => $_GET['id']
])->findOrFail();

view("deportes/edit.view.php", [
    'heading' => 'Editar deporte',
    'errors' => [],
    'deporte' => $deporte
]);