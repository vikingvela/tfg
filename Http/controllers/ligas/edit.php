<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$currentUserId = 1;

$liga = $db->query('select * from LIGA where id = :id', [
    'id' => $_GET['id']
])->findOrFail();

authorize($liga['user_id'] === $currentUserId);

view("ligas/edit.view.php", [
    'heading' => 'Editar liga',
    'errors' => [],
    'liga' => $liga
]);