<?php

use Core\App;
use Core\Database;

echo "clasificacion/edit.php";

$db = App::resolve(Database::class);

// Encontrar el partido correspondiente al id
$partido = $db->query('SELECT * from PARTIDO where id = :id', [
    'id' => $_GET['id']
])->findOrFail();

// Encontrar la jornada correspondiente al id
$jornada = $db->query('SELECT * from JORNADA where id = :id', [
    'id' => $partido['jornada_id']
])->findOrFail();

// Encontrar la liga correspondiente al id
$liga = $db->query('SELECT * from LIGA where id = :id', [
    'id' => $jornada['liga_id']
])->findOrFail();

// Autoriza que el usuario actual puede editar la liga
$usuario = getUsuarioIDbyEmail($_SESSION['usuario']['email']);
if(!authorize($liga['creado_por'] ===  $usuario || isAdmin($usuario))) $errors['autorizacion'] = 'No tienes autorización para editar esta liga.'; 


view("clasificaciones/edit.view.php", [
    'heading' => 'Editar resultados de la jornada '.$jornada['numero'].' de la liga '.$liga['nombre'],
    'errors' => [],
    'partido' => $partido,
    'jornada' => $jornada,
    'liga' => $liga
]);