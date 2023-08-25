<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

echo "equipos/show.php";

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
    'usuarios' => $usuarios,
    'ligas' => $ligas
]);