<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$equiposAdmin = [];
$usuarioID = null;

$equipos = $db->query('SELECT * FROM equipo')->get();
$ligas = $db->query('SELECT * FROM LIGA')->get();
$equipos_ligas = $db->query('SELECT * FROM EQUIPOS_LIGAS')->get();
$deportes = $db->query('SELECT * from DEPORTE')->get();


if(!empty($_SESSION)) {
    $usuarioID = getUsuarioIDbyEmail($_SESSION['usuario']['email']);
    $equiposAdmin = array_filter($equipos, function($equipo) use ($usuarioID) {
        return $equipo['creado_por'] == $usuarioID;
    });
    foreach($equiposAdmin as $equipo){
        $equipo['liga_id'] = null;
        $equipo['deporte_id'] = null;
        // por cada equipo en $equiposAdmin, se busca el equipo en $equipos_ligas que tenga el mismo equipo_id y se añade la variable $liga_id y $deporte_id al array $equipo
        foreach($equipos_ligas as $equipo_liga){
            if($equipo['id'] == $equipo_liga['equipo_id']){
                $equipo['liga_id'] = $equipo_liga['liga_id'];
                //$equipo['deporte_id'] = $equipo_liga['deporte_id'];
            }
        }
    }
}

view("equipos/index.view.php", [
    'heading' => 'Equipos',
    'equipos' => $equipos,
    'equiposAdmin' => $equiposAdmin,
    'ligas' => $ligas,
    'deportes' => $deportes,
    'equipos_ligas' => $equipos_ligas,
    'usuarioID' =>  $usuarioID
]);