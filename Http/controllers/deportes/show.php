<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$currentUserId = 1;

$liga = $db->query('select * from DEPORTE where id = :id', [
    'id' => $_GET['id']
])->findOrFail();

authorize($deporte['user_id'] === $currentUserId);

view("deportes/show.view.php", [
    'heading' => 'deporte',
    'deporte' => $deporte
]);
