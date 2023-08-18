<?php

use Core\App;
use Core\Database;
echo "usuarios/show.php";

$db = App::resolve(Database::class);

$usuarioActual = null;
if (!empty($_SESSION))
    $usuarioActual = $db->query('SELECT * from USUARIO where email = :email', [
        'email' => $_SESSION['usuario']['email']
    ])->findOrFail();

$usuario = $db->query('SELECT * from USUARIO where id = :id', [
    'id' => $_GET['id']
])->findOrFail();

$jugador = $db->query('SELECT * from jugador where usuario_id = :id', [
    'id' => $_GET['id']
])->get();

$equipos = [];
foreach ($jugador as $jug) {
    $equipo = $db->query('SELECT * from equipo where id = :id', [
        'id' => $jug['equipo_id']
    ])->get();
    /*
    $ligas = $db->query('SELECT * from liga where id = :id', [
        'id' => $equipo['liga_id']
    ])->get();
    foreach ($ligas as $liga) {
        $equipo['liga_id'] = $liga['id'];
        $equipo['liga_nombre'] = $liga['nombre'];
    }
    */
    $equipos[] = $equipo;
}

view("usuarios/show.view.php", [
    'heading' => 'Perfil',
    'equipos' => $equipos,
    'usuarioActual' => $usuarioActual,
    'usuario' => $usuario
]);