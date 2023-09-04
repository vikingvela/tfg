<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$liga = $db->query('SELECT * from liga where id = :id', [
    'id' => $_GET['id']
])->findOrFail();

$equipos = $db->query('SELECT * from equipos_ligas where liga_id = :id', [
    'id' => $_GET['id']
])->get();

$solicitudesLiga = [];
$solicitudes = [];
if(isset($_SESSION['usuario']) && getUsuarioIDbyEmail($_SESSION['usuario']['email']) === $liga['creado_por']) {
    $liga['admin'] = 1;
    $solicitudesLiga = $db->query('SELECT * from solicitudesLigas where liga_id=:liga_id and estado=:estado', [
        'liga_id' => $liga['id'],
        'estado' => '1'
    ])->get();
    foreach ($solicitudesLiga as $solicitud){
        $equipo=$db->query('SELECT * from equipo where id=:equipo_id',[
            'equipo_id' => $solicitud['equipo_id']
        ])->find();
        $equipo['solicitud']=$solicitud['estado'];
        $solicitudes[]=$equipo;
    }
}

$clasificaciones = $db->query('SELECT * from clasificacion where liga_id = :id', [
    'id' => $_GET['id']
])->get();

// Añade a cada clasificación de cada equipo el nombre del equipo
foreach ($clasificaciones as &$clasificacion) {
    $clasificacion['nombre'] = $db->query('SELECT nombre FROM equipo WHERE id = :id', [
        'id' => $clasificacion['equipo_id']
    ])->find();
}

usort($clasificaciones, function ($a, $b) {
    if ($a['puntos'] != $b['puntos']) {
        return $b['puntos'] - $a['puntos'];
    } elseif ($a['gf'] != $b['gf']) {
        return $b['gf'] - $a['gf'];
    } elseif ($a['gc'] != $b['gc']) {
        return $a['gc'] - $b['gc'];
    } else {
        return $b['dif'] - $a['dif'];
    }
});

// Carga las jornadas con los partidos correspondientes
$jornadas = $db->query('SELECT * from jornada where liga_id = :id', [
    'id' => $_GET['id']
])->get();

$resultados = [];
foreach ($jornadas as $jornada) {
    $partidos = $db->query('SELECT * from partido where jornada_id = :id', [
        'id' => $jornada['id']
    ])->get();
    $jornada['partidos'] = $partidos;
    $resultados[] = $jornada;
}

//dd($resultados);

view("ligas/show.view.php", [
    'heading' => 'Información sobre la liga',
    'equipos' => $equipos,
    'solicitudes' => $solicitudes,
    'liga' => $liga,
    'clasificaciones' => $clasificaciones,
    'jornadas' => $resultados
]);