<?php

use Core\App;
use Core\Database;

echo "equipos/index.php";

$db = App::resolve(Database::class);

$equiposAdmin = [];
$usuarioID = null;

$equipos = $db->query('SELECT * FROM equipo')->get();
$ligas = $db->query('SELECT * FROM LIGA')->get();

// Se asocian a las variables $equiposAdmin y $usuarioID los equipos creados por el usuario logeado, y se sobreescribe la variable $equipos con los equipos que están activos
if(!empty($_SESSION)) {
    $usuarioID = getUsuarioIDbyEmail($_SESSION['usuario']['email']);
    $equiposAdmin = array_filter($equipos, function($equipo) use ($usuarioID) {
        return $equipo['creado_por'] == $usuarioID;
    });
}
// Filstra los equipos que tengan el campo 'estado'>1
$equipos = array_filter($equipos, function($equipo) {
    return $equipo['estado'] > 1;
});

view("equipos/index.view.php", [
    'heading' => 'equipos',
    'equipos' => $equipos,
    'equiposAdmin' => $equiposAdmin,
    'ligas' => $ligas,
    'usuarioID' =>  $usuarioID
]);