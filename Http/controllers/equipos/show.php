<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

echo "equipos/show.php";


$liga = $db->query('select * from equipo where id = :id', [
    'id' => $_GET['id']
])->findOrFail();

authorize($equipo['user_id'] === $currentUserId);

view("equipos/show.view.php", [
    'heading' => 'equipo',
    'equipo' => $equipo
]);
