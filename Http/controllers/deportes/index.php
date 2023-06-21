<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);
$ligas = $db->query('select * from DEPORTE')->get();
//$ligas = $db->query('select * from LIGA where user_id = 1')->get();

view("ligas/index.view.php", [
    'heading' => 'Deportes',
    'Deportes' => $deportes
]);