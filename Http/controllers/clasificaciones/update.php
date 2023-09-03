<?php

use Core\App;
use Core\Database;
use Core\Validator;

echo "clasificacion/update.php";

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


$db->updateID('PARTIDO', $partido['id'], array(
    'fecha_hora' => $_POST['fecha_hora'],
    'resultado_local' => $_POST['resultado_local'],
    'resultado_visitante' => $_POST['resultado_visitante']
));

// RESOLUCION DE PUNTOS PARA LA CLASIFICACION
if($partido['resultado_local'] > $partido['resultado_visitante']){
    // Local ganador
    actualizarClasificacion($partido['equipo_local_id'], $liga['id'], 3, 1, 1, 0, 0, $partido['resultado_local'], $partido['resultado_visitante'], $partido['resultado_local'] - $partido['resultado_visitante']);
    actualizarClasificacion($partido['equipo_visitante_id'], $liga['id'], 0, 1, 0, 0, 1, $partido['resultado_visitante'], $partido['resultado_local'], $partido['resultado_visitante'] - $partido['resultado_local']);
} else if ($partido['resultado_local'] < $partido['resultado_visitante']){
    // Visitante ganador
    actualizarClasificacion($partido['equipo_local_id'], $liga['id'], 0, 1, 1, 0, 1, $partido['resultado_local'], $partido['resultado_visitante'], $partido['resultado_local'] - $partido['resultado_visitante']);
    actualizarClasificacion($partido['equipo_visitante_id'], $liga['id'], 3, 1, 0, 0, 9, $partido['resultado_visitante'], $partido['resultado_local'], $partido['resultado_visitante'] - $partido['resultado_local']);
} else if ($partido['resultado_local'] == $partido['resultado_visitante']){
    // Empate
    actualizarClasificacion($partido['equipo_local_id'], $liga['id'], 1, 1, 0, 1, 0, $partido['resultado_local'], $partido['resultado_visitante'], $partido['resultado_local'] - $partido['resultado_visitante']);
    actualizarClasificacion($partido['equipo_visitante_id'], $liga['id'], 1, 1, 0, 1, 0, $partido['resultado_visitante'], $partido['resultado_local'], $partido['resultado_visitante'] - $partido['resultado_local']);
} 

function actualizarClasificacion ($equipo_id, $liga_id, $puntos, $jugados, $ganados, $empatados, $perdidos, $favor, $contra, $diferencia){
    $db = App::resolve(Database::class);
    $clasificacion = $db->query('SELECT * from CLASIFICACION where liga_id=:liga_id and equipo_id=:equipo_id', [
        'liga_id' => $liga_id,
        'equipo_id' => $equipo_id
    ])->findOrFail();
    
    $db->updateID('CLASIFICACION', $clasificacion['id'], array(
        'puntos' => $clasificacion['puntos'] + $puntos,
        'pj' => $clasificacion['jugados'] + $jugados,
        'pg' => $clasificacion['ganados'] + $ganados,
        'pe' => $clasificacion['empatados'] + $empatados,
        'pp' => $clasificacion['perdidos'] + $perdidos,
        'gf' => $clasificacion['favor'] + $favor,
        'gc' => $clasificacion['contra'] + $contra,
        'dif' => $clasificacion['diferencia'] + $diferencia
    ));
}


// Redirige al usuario
header('location: /ligas');
die();
