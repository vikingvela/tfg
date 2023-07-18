<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$currentUserId = 1;

$liga = $db->query('select * from ligas where id = :id', [
    'id' => $_GET['id']
])->findOrFail();

authorize($liga['creado_por'] === $currentUserId);

view("ligas/show.view.php", [
    'heading' => 'liga',
    'liga' => $liga
]);
