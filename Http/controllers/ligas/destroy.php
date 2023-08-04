<?php

use Core\App;
use Core\Database;

echo "ligas/destroy.php"

$db = App::resolve(Database::class);

$currentUserId = 1;

$liga = $db->query('select * from LIGA where id = :id', [
    'id' => $_POST['id']
])->findOrFail();

authorize($liga['user_id'] === $currentUserId);

$db->query('delete from LIGA where id = :id', [
    'id' => $_POST['id']
]);

header('location: /ligas');
exit();
