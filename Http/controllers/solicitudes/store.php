<?php
use Core\App;
use Core\Validator;
use Core\Database;
echo "solicitudes/store.php";

$db = App::resolve(Database::class);
$errors = [];

if (!empty($_POST['liga_id'])) {
  $db->insert('solicitudesLigas', [
    'liga_id' => $_POST['liga_id'],
    'equipo_id' => $_POST['equipo_id']
  ]);
} else {
  $errors['liga_id'] = 'No se ha seleccionado ninguna liga';
}
redirect('/solicitudes/ligas?id=' . $_POST['equipo_id']);
die();