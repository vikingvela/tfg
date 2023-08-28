<?php

use Core\App;
use Core\Database;

echo "solicitudes/equipos.php";

$db = App::resolve(Database::class);

$equipo = getbyID($_GET['id'], 'EQUIPO');
$usuario = getbyID(getUsuarioIDbyEmail($_SESSION['usuario']['email']), 'USUARIO');

!authorize($equipo['creado_por'] ===  $usuario['id'] || isAdmin($usuario['id']));

$ligas_abiertas = $db->query('SELECT * FROM LIGA where estado = 1')->get();
$deportes = $db->query('SELECT * from DEPORTE')->get();
$solicitudesLigas = $db->query('SELECT * from SOLICITUDESLIGAS where equipo_id = :id', [
    'id' => $_GET['id']
])->get();


$ligas=[];
foreach ($ligas_abiertas as $liga) {
    foreach ($deportes as $deporte) {
        if ($deporte['id'] === $liga['deporte_id']) {
            $liga['deporte'] = $deporte['nombre'];
            break;
        }        
    }
    foreach ($solicitudesLigas as &$solicitud) {
        if ($solicitud['liga_id'] === $liga['id']) {
            $liga['solicitud'] = $solicitud['estado'];
        }
    }
    $liga['solicitud'] ?? $liga['solicitud'] = -1;
    $ligas[] = $liga;
}

view("solicitudes/equipos.view.php", [
    'heading' => 'Equipos',
    'ligas' => $ligas,
    'equipo' => $equipo,
    'solicitudesLigas' => $solicitudesEquipos,
    'errors' => []
]);