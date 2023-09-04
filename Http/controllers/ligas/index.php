<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$ligas = $db->query('SELECT * FROM LIGA')->get();
$ligasAdmin = [];

if(!empty($_SESSION)) {
    $usuarioID = getUsuarioIDbyEmail($_SESSION['usuario']['email']);
    if(isGestor($usuarioID)) {
        $ligasAdmin = array_filter($ligas, function($liga) use ($usuarioID) {
            return $liga['creado_por'] == $usuarioID;
        });
    }
}
$deportes = $db->query('SELECT * from DEPORTE')->get();

view("ligas/index.view.php", [
    'heading' => 'Ligas',
    'ligas' => $ligas,
    'ligasAdmin' => $ligasAdmin,
    'deportes' => $deportes
]);