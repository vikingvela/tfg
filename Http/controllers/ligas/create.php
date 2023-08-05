<?php

use Core\App;
use Core\Database;
use Core\Session;

echo "ligas/create.php";

$db = App::resolve(Database::class);

view("ligas/create.view.php", [
    'heading' => 'Crear nueva liga',
    'deportes_disponibles' => $db->query('SELECT * from deporte')->get(),
    'errors' => Session::get('errors')
]);