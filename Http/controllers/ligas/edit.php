<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);
$liga = $db->query('select * from LIGA where id = :id', [
    'id' => $_GET['id']
])->findOrFail();
$deportes_disponibles = $db->query('SELECT * from deporte')->get();
$currentUserId = getUsuarioIDbyEmail($_SESSION['usuario']['email']);
authorize($liga['creado_por'] ===  $currentUserId || isAdmin($currentUserId));

view("ligas/edit.view.php", [
    'heading' => 'Información sobre la liga',
    'errors' => [],
    'deportes_disponibles' => $deportes_disponibles,
    'liga' => $liga
]);