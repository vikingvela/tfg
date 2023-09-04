<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$liga = $db->query('select * from equipo where id = :id', [
    'id' => $_POST['id']
])->findOrFail();

authorize($equipo['creado_por'] === $currentUserId);

$db->query('delete from equipo where id = :id', [
    'id' => $_POST['id']
]);

header('location: /equipos');
exit();
