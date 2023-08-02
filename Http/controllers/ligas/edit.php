<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);
$liga = $db->query('select * from LIGA where id = :id', [
    'id' => $_GET['id']
])->findOrFail();

$currentUserId = getUsuarioIDbyEmail($_SESSION['usuario']['email']);
authorize($liga['creado_por'] ===  $currentUserId || isAdmin($currentUserId));

view("ligas/edit.view.php", [
    'heading' => 'Información sobre la liga',
    'errors' => [],
    'liga' => $liga
]);