<?php

use Core\App;
use Core\Database;

echo "ligas/show.php";

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

view("ligas/show.view.php", [
    'heading' => 'Información sobre la liga',
    'equipos' => $equipos,
    'solicitudes' => $solicitudes,
    'liga' => $liga
]);