<?php

use Core\App;
use Core\Database;
use Core\Validator;

echo "clasificacion/update.php";

dd($_GET);
$db = App::resolve(Database::class);
$errors = [];

// Encontrar el partido correspondiente al id
$partido = $db->query('SELECT * from PARTIDO where id = :id', [
    'id' => $_POST['id']
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


$datos = array(
    'nombre' => $_POST['nombre'],
    'descripcion' => $_POST['descripcion'],
    'deporte_id' => $_POST['deporte'],
    'modificado_por' => getUsuarioIDbyEmail($_SESSION['usuario']['email']),
    'fecha_inicio' => $_POST['fecha_inicio'],
    'fecha_fin' => $_POST['fecha_fin']
);
$db->updateID('LIGA', $_POST['id'], $datos);


// Redirige al usuario
header('location: /ligas');
die();
