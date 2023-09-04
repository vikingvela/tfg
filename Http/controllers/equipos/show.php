<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$usuarioActual = null;
if ($_SESSION['usuario'] ?? false) :  {
    $usuarioActual = $db->query('select * from USUARIO where email = :email', [
        'email' => $_SESSION['usuario']['email']
    ])->findOrFail();
} endif;

// EQUIPO
$equipo = $db->query('SELECT * from equipo where id = :id', [
    'id' => $_GET['id']
])->findOrFail();

// DEPORTES
$deportes = $db->query('SELECT * from deporte')->get();

// LIGAS
$ligas_equipo = $db->query('SELECT * from equipos_ligas where equipo_id = :id', [
    'id' => $_GET['id']
])->get();

$ligas=[];
if(!empty($ligas_equipo)){
    // por cada liga del equipo en $ligas_equipo busco la liga en la tabla liga y lo guardo en $ligas
    foreach ($ligas_equipo as $liga_equipo) {
        $liga = $db->query('SELECT * from liga where id = :id', [
            'id' => $liga_equipo['liga_id']
        ])->findOrFail();
        foreach ($deportes as $deporte) {
            if ($deporte['id'] === $liga['deporte_id']) {
                $liga['deporte'] = $deporte['nombre'];
            }        
        }
        $ligas[] = $liga;
    }
}
if(isset($_SESSION['usuario']) && getUsuarioIDbyEmail($_SESSION['usuario']['email']) === $equipo['creado_por']) {
    $equipo['admin'] = 1;
}

// JUGADORES
$jugadores = $db->query('SELECT * from jugador where equipo_id = :id', [
    'id' => $_GET['id']
])->get();

// SOLICITUDES Equipos
if(isset($_SESSION['usuario'])) {
    (int)$solicitud = $db->query('SELECT estado from solicitudesEquipos where equipo_id = :id and usuario_id = :usuario_id',  [
        'id' => $_GET['id'],
        'usuario_id' => $usuarioActual['id']
    ])->find();
    if(!empty($solicitud)) $equipo['solicitud'] = $solicitud['estado'];
    else $equipo['solicitud'] = -1;
}

$solicitudes = $db->query('SELECT * from solicitudesEquipos where equipo_id = :id and estado=:estado', [
    'id' => $_GET['id'],
    'estado' => '1'
])->get();

$solicitudesJugadores = [];
// si $solicitudesJugadores no está vacío, por cada solicitud, recupera el usuario_id, consulta la tabla equipo y crea un array llamado $solicitudesJugadores con los jugadores con estos ids
if(!empty($solicitudes)){
    foreach ($solicitudes as &$solicitud) {
        $jugador = $db->query('SELECT * from usuario where id = :id', [
            'id' => $solicitud['usuario_id'],
        ])->find();
        $jugador['solicitud'] = $solicitud['estado'];
        $solicitudesJugadores[] = $jugador;
        unset($jugador);
    }
}

$usuarios = [];

if(!empty($jugadores)){
    foreach($jugadores as $jugador){
        $usuario = $db->query('SELECT * from usuario where id = :id', [
            'id' => $jugador['usuario_id']
        ])->findOrFail();
        $usuarios[] = $usuario;
    }
}

view("equipos/show.view.php", [
    'heading' => 'Equipo',
    'equipo' => $equipo,
    'solicitudesJugadores' => $solicitudesJugadores,
    'usuarioActual' => $usuarioActual,
    'usuarios' => $usuarios,
    'ligas' => $ligas
]);