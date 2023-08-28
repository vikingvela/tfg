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

$solicitudesLigas = [];
if(isset($_SESSION['usuario']) && getUsuarioIDbyEmail($_SESSION['usuario']['email']) === $liga['creado_por']) {
    $liga['admin'] = 1;
    $solicitudesLigas=$db->query('SELECT * from solicitudesLigas where liga_id=:liga_id and estado="1"', [
        'liga_id' => $liga['id']
    ]);
    $liga['solicitudesLigas']=$solicitudesLigas;
    dd($solicitudesLigas);
    foreach ($solicitudesLigas as $solicitud){
        $equipo=$db->query('SELECT * from equipos where id=:equipo_id',[
            'equipo_id' => $solicitud['equipo_id']
        ])->get();
        $liga['equipossolicitudes'][]=$equipo;
    }
}


view("ligas/show.view.php", [
    'heading' => 'Información sobre la liga',
    'equipos' => $equipos,
    'liga' => $liga
]);