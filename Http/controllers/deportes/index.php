<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$deportes = $db->query('SELECT * FROM DEPORTE')->get();

view("deportes/index.view.php", [
    'heading' => 'Deportes',
    'deportes' => $deportes
]);