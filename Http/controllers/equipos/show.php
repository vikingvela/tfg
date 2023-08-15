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

if(!empty($ligas_equipo)){
    $ligas=[];
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

// JUGADORES
$jugadores = $db->query('SELECT * from jugador where equipo_id = :id', [
    'id' => $_GET['id']
])->get();

view("equipos/show.view.php", [
    'heading' => 'Equipo',
    'equipo' => $equipo,
    'jugadores' => $jugadores,
    'ligas' => $ligas
]);