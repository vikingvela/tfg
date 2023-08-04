<?php

use Core\App;
use Core\Database;

echo "deportes/index.php";

$db = App::resolve(Database::class);

$deportes = $db->query('SELECT * FROM DEPORTE')->get();

view("deportes/index.view.php", [
    'heading' => 'Deportes',
    'deportes' => $deportes
]);