<?php

use Core\App;
use Core\Database;
use Core\Validator;


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
actualizarResultado($partido['equipo_local_id'],$liga, [$_POST['resultado_local'], $_POST['resultado_visitante']]);
actualizarResultado($partido['equipo_visitante_id'],$liga, [$_POST['resultado_visitante'], $_POST['resultado_local']]);


function actualizarResultado($equipo_id,$liga, $resultado){
    
    switch($liga['deporte_id']){
        
        case '0': // 'Fútbol';
        default:   if($resultado[0]>$resultado[1]){
                        $puntos = 3;
                        $ganados = 1;
                        $empatados = 0;
                        $perdidos = 0;
                        $favor = $resultado[0];
                        $contra = $resultado[1];
                        $diferencia = $resultado[0] - $resultado[1];
                    } else if ($resultado[0]<$resultado[1]){
                        $puntos = 0;
                        $ganados = 0;
                        $empatados = 0;
                        $perdidos = 1;
                        $favor = $resultado[0];
                        $contra = $resultado[1];
                        $diferencia = $resultado[0] - $resultado[1];
                    } else if ($resultado[0]==$resultado[1]){
                        $puntos = 1;
                        $ganados = 0;
                        $empatados = 1;
                        $perdidos = 0;
                        $favor = $resultado[0];
                        $contra = $resultado[1];
                        $diferencia = $resultado[0] - $resultado[1];
                    }
                    actualizarClasificacion ($equipo_id, $liga['id'], $puntos, 1, $ganados, $empatados, $perdidos, $favor, $contra, $diferencia);
        break;
    }
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
    $db->updateID('PARTIDO', $partido['id'], array(
        'estado' => 2
    ));


// Redirige al usuario
header('location: /ligas');
die();
