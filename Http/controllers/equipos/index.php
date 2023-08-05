<?php

use Core\App;
use Core\Database;

echo "equipos/index.php";

$db = App::resolve(Database::class);

$equipos = $db->query('SELECT * FROM equipo')->get();

view("equipos/index.view.php", [
    'heading' => 'equipos',
    'equipos' => $equipos
]);