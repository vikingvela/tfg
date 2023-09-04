<?php

use Core\App;
use Core\Database;
use Core\Session;


$db = App::resolve(Database::class);
$liga = $db->query("SELECT * FROM liga WHERE id = :id", [
    'id' => $_GET['id']
])->find();

authorize($liga['creado_por'] === getUsuarioIDbyEmail($_SESSION['usuario']['email']));


view("clasificaciones/create.view.php", [
    'heading' => 'Crear nueva clasificación y jornadas de una liga',
    'errors' => Session::get('errors'),
    'liga' => $liga
]);