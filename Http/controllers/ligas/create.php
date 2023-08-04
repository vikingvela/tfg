<?php

use Core\App;
use Core\Database;
use Core\Session;

echo "ligas/create.php";

$db = App::resolve(Database::class);
//$ligas = $db->query('select * from LIGA')->get();
//$ligas = $db->query('select * from LIGA where user_id = 1')->get();

// Paso 2: Realizar la consulta a la base de datos para obtener los deportes disponibles
view("ligas/create.view.php", [
    'heading' => 'Crear nueva liga',
    'deportes_disponibles' => $db->query('SELECT * from deporte')->get(),
    'errors' => Session::get('errors')
]);