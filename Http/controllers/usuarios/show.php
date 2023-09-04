<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$usuarioActual = null;
if (!empty($_SESSION))
    $usuarioActual = $db->query('SELECT * from USUARIO where email = :email', [
        'email' => $_SESSION['usuario']['email']
    ])->findOrFail();

$usuario = $db->query('SELECT * from USUARIO where id = :id', [
    'id' => $_GET['id']
])->findOrFail();

$solicitudesEquipos = $db->query('SELECT * from SOLICITUDESEQUIPOS where usuario_id = :id', [
    'id' => (int)$usuario['id']
])->get();

$jugador = $db->query('SELECT equipo_id from jugador where usuario_id = :id', [
    'id' => $_GET['id']
])->get();

$equipos = [];
// recorrer el array de jugadores y por cada jugador, recuperar el equipo_id y crear un array con estos ids
foreach ($jugador as &$jug) {
    $equipo = $db->query('SELECT * from equipo where id = :id', [
        'id' => $jug['equipo_id']
    ])->findOrFail();
    $equipos[] = $equipo;
}

// recorre el array solciitudesEquipos y por cada solicitud, recuperar el equipo_id, consulta la tabla equipo crear un array llamado $solicitudes con los equipos con estos ids
$solicitudes = [];
foreach ($solicitudesEquipos as &$solicitud) {
    $equipo_solicitado = $db->query('SELECT * from equipo where id = :id', [
        'id' => $solicitud['equipo_id']
    ])->find();
    $equipo_solicitado['solicitud'] = $solicitud['estado'];
    $solicitudes[] = $equipo_solicitado;
}

view("usuarios/show.view.php", [
    'heading' => 'Perfil',
    'solicitudes' => $solicitudes,
    'equipos' => $equipos,
    'usuarioActual' => $usuarioActual,
    'usuario' => $usuario
]);