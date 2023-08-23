<?php

use Core\App;
use Core\Database;
use Core\Session;

/*
    Según el 'estado' de la liga su comportamiento es diferente:
    - 0: Liga inactiva, no se puede invitar a equipos a participar en la liga
    - 1: Liga activa, puede invitar a equipos a participar en la liga
    - 2: Liga activa y en curso, no se pueden editar los emparejamientos. Se pueden editar los resultados y las fechas de las jornadas
    - 3: Liga finalizada, se pueden editar los resultados antes de validar
    - 4: Liga finalizada y validada, no se puede editar nada
*/



echo "ligas/create.php";

$db = App::resolve(Database::class);

view("ligas/create.view.php", [
    'heading' => 'Crear nueva liga',
    'deportes_disponibles' => $db->query('SELECT * from deporte')->get(),
    'errors' => Session::get('errors')
]);