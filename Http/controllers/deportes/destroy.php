<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$currentUserId = 1;

$liga = $db->query('select * from DEPORTE where id = :id', [
    'id' => $_POST['id']
])->findOrFail();

authorize($deporte['user_id'] === $currentUserId);

$db->query('delete from DEPORTE where id = :id', [
    'id' => $_POST['id']
]);

header('location: /deportes');
exit();
