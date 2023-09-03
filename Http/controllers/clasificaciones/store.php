<?php
use Core\App;
use Core\Validator;
use Core\Database;

echo "clasificacion/store.php";

$db = App::resolve(Database::class);
$errors = [];

$liga = $db->query("SELECT * FROM liga WHERE id = :id", [
    'id' => (int)$_POST['liga']
])->find();

authorize($liga['creado_por'] === getUsuarioIDbyEmail($_SESSION['usuario']['email']) || isAdmin(getUsuarioIDbyEmail($_SESSION['usuario']['email'])));

$equipos_liga = $db->query("SELECT * FROM equipos_ligas WHERE liga_id = :id", [
    'id' => (int)$_POST['liga']
])->get();


$equipos = [];
foreach ($equipos_liga as $equipo_liga) {
    $equipo = $db->query("SELECT * FROM equipo WHERE id = :id", [
        'id' => $equipo_liga['equipo_id']
    ])->find();
    $equipos_id[] = $equipo['id'];
    $equipos[] = $equipo;
    // Crea la entrada en la tabla clasificacion para cada equipo de la liga
    try {
        // Intenta insertar en la tabla 'clasificacion'
        $db->insert('clasificacion', [
            'equipo_id' => $equipo['id'],
            'liga_id' => $liga['id']
        ]);
    } catch (PDOException $e) {
        echo "Error al insertar en la tabla 'clasificacion': " . $e->getMessage();
    }
}

// Array de equipos

// Función para generar las jornadas de partidos
function generarJornadas($equipos, $idaYVuelta) {
    $totalEquipos = count($equipos);
    $jornadas = array();

    if ($totalEquipos % 2 != 0) {
        array_push($equipos, 0);
        $totalEquipos++;
    }

    for ($i = 1; $i < $totalEquipos; $i++) {
        $jornada = array();

        for ($j = 0; $j < $totalEquipos / 2; $j++) {
            if ($equipos[$j] != 0 && $equipos[$totalEquipos - $j - 1] != 0) {
                $partido = array($equipos[$j], $equipos[$totalEquipos - $j - 1]);
                $jornada[] = $partido;
            }
        }

        $jornadas[] = $jornada;

        // Rotar equipos para la siguiente ronda
        $ultimoEquipo = array_pop($equipos);
        array_splice($equipos, 1, 0, $ultimoEquipo);
    }

    if ($idaYVuelta) {
        $ida = $jornadas;
        $vuelta = array_map(function ($jornada) {
            return array_map(function ($partido) {
                return array_reverse($partido);
            }, $jornada);
        }, array_reverse($jornadas));

        return array_merge($ida, $vuelta);
    } else {
        return $jornadas;
    }
}

// Generar jornadas
if($_POST['idayvuelta'] == '1') {
    $idaYVuelta = true;
} else {
    $idaYVuelta = false;
}

$jornadas = generarJornadas($equipos_id, $idaYVuelta);

for($jor = 0; $jor < count($jornadas); $jor++) {
    try {
        // Intenta insertar en la tabla 'jornada'
        $db->insert('jornada', [
            'numero' => $jor + 1,
            'liga_id' => $liga['id'],
            'fecha_inicio' => $liga['fecha_inicio'],
            'fecha_fin' => $liga['fecha_inicio']
        ]);
    } catch (PDOException $e) {
        echo "Error al insertar en la tabla 'jornada': " . $e->getMessage();
    }
}

for ($jor = 0; $jor < count($jornadas); $jor++) {
    $jornada_id = $db->query("SELECT id FROM jornada WHERE liga_id = :id AND numero = :numero", [
        'numero' => $jor + 1,
        'id' => $liga['id']
    ])->find();

    for ($partido = 0; $partido < count($jornadas[$jor]); $partido++) {
        try {
            // Intenta insertar en la tabla 'partido'
            $db->insert('partido', [
                'jornada_id' => (int)$jornada_id['id'],
                'equipo_local_id' => $jornadas[$jor][$partido][0],
                'equipo_visitante_id' => $jornadas[$jor][$partido][1],
                'fecha_hora' => $liga['fecha_inicio']
            ]);
        } catch (PDOException $e) {
            echo "Error al insertar en la tabla 'partido': " . $e->getMessage();
        }
    }
}

// Cambia el estado de la liga a 2 (en curso)
try {
    // Intenta actualizar en la tabla 'liga'
    $db->updateID('liga', $liga['id'], [
        'estado' => 2
    ]);

} catch (PDOException $e) {
    echo "Error al actualizar en la tabla 'liga': " . $e->getMessage();
}


// Crear notificaciones para todos los usuarios de la liga


/*
view("clasificacion/edit.php", [
    'heading' => 'Completa las fechas de las jornadas',
    'liga' => $liga,
    'equipos' => $equipos,
    'jornadas' => $jornadas
]);
*/
header('location: /ligas');
die();