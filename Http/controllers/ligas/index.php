<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);
//$usuarioID = getUsuarioIDbyEmail($_SESSION['usuario']['email']);
//$ligas = $db->query('select * from LIGA')->get();
$ligasAdmin = $db->query('select * from LIGA where creado_por = ' . getUsuarioIDbyEmail($_SESSION['usuario']['email']))->get();
$deportes = $db->query('select * from DEPORTE')->get();

view("ligas/index.view.php", [
    'heading' => 'Ligas',
    'ligasAdmin' => $ligasAdmin,
    'deportes' => $deportes
]);