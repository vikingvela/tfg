<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$currentUserId = 1;

$liga = $db->query('select * from USUARIO where id = :id', [
    'id' => $_POST['id']
])->findOrFail();

authorize($usuario['creado_por'] === $currentUserId);

$db->query('delete from USUARIO where id = :id', [
    'id' => $_POST['id']
]);

header('location: /usuarios');
exit();
