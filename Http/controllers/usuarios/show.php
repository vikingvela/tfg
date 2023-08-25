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

view("usuarios/show.view.php", [
    'heading' => 'Perfil',
    'equipos' => $equipos,
    'usuarioActual' => $usuarioActual,
    'usuario' => $usuario
]);