<?php

use Core\App;
use Core\Database;

echo "equipos/index.php";

$db = App::resolve(Database::class);

$equiposAdmin = [];
$usuarioID = null;

$equipos = $db->query('SELECT * FROM equipo')->get();
$ligas = $db->query('SELECT * FROM LIGA')->get();
$equipos_ligas = $db->query('SELECT * FROM EQUIPOS_LIGAS')->get();
$deportes = $db->query('SELECT * from DEPORTE')->get();


// Se asocian a las variables $equiposAdmin y $usuarioID los equipos creados por el usuario logeado, y se sobreescribe la variable $equipos con los equipos que están activos
if(!empty($_SESSION)) {
    $usuarioID = getUsuarioIDbyEmail($_SESSION['usuario']['email']);
    $equiposAdmin = array_filter($equipos, function($equipo) use ($usuarioID) {
        return $equipo['creado_por'] == $usuarioID;
    });
}

view("equipos/index.view.php", [
    'heading' => 'Equipos',
    'equipos' => $equipos,
    'equiposAdmin' => $equiposAdmin,
    'ligas' => $ligas,
    'deportes' => $deportes,
    'equipos_ligas' => $equipos_ligas,
    'usuarioID' =>  $usuarioID
]);