<?php

use Core\App;
use Core\Database;

echo "ligas/index.php";

$db = App::resolve(Database::class);

$ligas = $db->query('SELECT * FROM LIGA')->get();
$usuarioID = getUsuarioIDbyEmail($_SESSION['usuario']['email']);
$ligasAdmin = array_filter($ligas, function($liga) use ($usuarioID) {
    return $liga['creado_por'] == $usuarioID;
});
$deportes = $db->query('select * from DEPORTE')->get();

view("ligas/index.view.php", [
    'heading' => 'Ligas',
    'ligas' => $ligas,
    'ligasAdmin' => $ligasAdmin,
    'deportes' => $deportes
]);