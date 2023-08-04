<?php

use Core\App;
use Core\Database;

echo "ligas/edit.php";

$db = App::resolve(Database::class);

// Encontrar la liga correspondiente al id
$liga = $db->query('SELECT * from LIGA where id = :id', [
    'id' => $_GET['id']
])->findOrFail();

// Mostrar todos los deportes disponibles
$deportes_disponibles = $db->query('SELECT * from deporte')->get();

// Autoriza que el usuario actual puede editar la liga
$usuario = getUsuarioIDbyEmail($_SESSION['usuario']['email']);
if(!authorize($liga['creado_por'] ===  $usuario || isAdmin($usuario))) 
    $errors['autorizacion'] = 'No tienes autorización para editar esta liga.'; 

view("ligas/edit.view.php", [
    'heading' => 'Información sobre la liga',
    'errors' => [],
    'deportes_disponibles' => $deportes_disponibles,
    'liga' => $liga
]);