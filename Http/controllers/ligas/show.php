<?php

use Core\App;
use Core\Database;

echo "ligas/show.php";

$db = App::resolve(Database::class);

$liga = $db->query('SELECT * from liga where id = :id', [
    'id' => $_GET['id']
])->findOrFail();

$equipos = $db->query('SELECT * from equipos_ligas where liga_id = :id', [
    'id' => $_GET['id']
])->get();


view("ligas/show.view.php", [
    'heading' => 'Información sobre la liga',
    'equipos' => $equipos,
    'liga' => $liga
]);
