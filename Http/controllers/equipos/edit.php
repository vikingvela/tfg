<?php

use Core\App;
use Core\Database;

echo "equipos/edit.php";

$db = App::resolve(Database::class);

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
        // JUGADORES POR LIGA
        $jugadores_equipo = $db->query('SELECT * from jugador where equipo_id = :id', [
            'id' => $liga_equipo['equipo_id']
        ])->get();

        if(!empty($jugadores_equipo)){
            $jugadores=[];
            // por cada jugador del equipo en $jugadores_equipo busco el jugador en la tabla jugador y lo guardo en $jugadores añadiendo el valor de 'invitacion'
            foreach ($jugadores_equipo as $jugador_equipo) {
                $jugador = $db->query('SELECT * from usuario where id = :id', [
                    'id' => $jugador_equipo['usuario_id']
                ])->findOrFail();
                $jugador['invitacion'] = $jugador_equipo['invitacion'];
                $liga['jugadores'] = $jugador;
            }
        }
        $ligas[] = $liga;
    }
}


view("equipos/edit.view.php", [
    'heading' => 'Editar equipo',
    'errors' => [],
    'ligas' => $ligas,
    'equipo' => $equipo
]);