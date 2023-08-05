<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

echo "deportes/show.php";

$liga = $db->query('select * from DEPORTE where id = :id', [
    'id' => $_GET['id']
])->findOrFail();

authorize($deporte['user_id'] === $currentUserId);

view("deportes/show.view.php", [
    'heading' => 'deporte',
    'deporte' => $deporte
]);
