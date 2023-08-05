<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

echo "deportes/destry.php";

$liga = $db->query('select * from DEPORTE where id = :id', [
    'id' => $_POST['id']
])->findOrFail();

authorize($deporte['creado_por'] === $currentUserId);

$db->query('delete from DEPORTE where id = :id', [
    'id' => $_POST['id']
]);

header('location: /deportes');
exit();
