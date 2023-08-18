<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

echo "deportes/show.php";

$liga = $db->query('select * from DEPORTE where id = :id', [
    'id' => $_GET['id']
])->findOrFail();

authorize(isset($_SESSION['usuario']) ?? false);

view("deportes/show.view.php", [
    'heading' => 'deporte',
    'deporte' => $deporte
]);
