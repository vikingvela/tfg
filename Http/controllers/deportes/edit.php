<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$currentUserId = 1;

$liga = $db->query('select * from DEPORTE where id = :id', [
    'id' => $_GET['id']
])->findOrFail();

authorize($note['user_id'] === $currentUserId);

view("deportes/edit.view.php", [
    'heading' => 'Editar deporte',
    'errors' => [],
    'ldeporte' => $deporte
]);