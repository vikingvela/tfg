<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$equipo = getbyID($_GET['id'], 'EQUIPO');
$usuario = getbyID(getUsuarioIDbyEmail($_SESSION['usuario']['email']), 'USUARIO');

$solicitudesEquipos = $db->query('SELECT * from SOLICITUDESEQUIPOS where usuario_id = :id', [
    'id' => (int)$usuario['id']
])->get();

$equipos=[];
$existe = false;

foreach ($solicitudesEquipos as &$solicitud){
    $equipo_solicitado=$db->query('SELECT * from EQUIPO where id = :id', [
        'id' => (int)$solicitud['equipo_id']
    ])->find();
    $equipo_solicitado['solicitud'] = $solicitud['estado'];
    if(!(int)$equipo_solicitado['id']==(int)$equipo['id']) $existe = true;

    $equipos[] = $equipo_solicitado;    
}
if(!$existe) {
    $db->insert('solicitudesEquipos', [
        'usuario_id' => (int)$usuario['id'],
        'equipo_id' => (int)$equipo['id']
    ]);
    $equipo['solicitud'] = 1;
    $equipos[] = $equipo;
}

view("solicitudes/equipos.view.php", [
    'heading' => 'Equipos',
    'equipos' => $equipos,
    'errors' => []
]);