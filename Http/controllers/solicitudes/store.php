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
  redirect('/solicitudes/ligas?id=' . $_POST['equipo_id']);
} else {
  $errors['liga_id'] = 'No se ha seleccionado ninguna liga';
}

if (!empty($_POST['equipo_id'])) {
  $db->insert('solicitudesEquipos', [
    'usuario_id' => $_POST['usuario_id'],
    'equipo_id' => $_POST['equipo_id']
  ]);
  redirect('/equipo/show?id=' . $_POST['equipo_id']);
} else {
  $errors['equipo_id'] = 'No se ha seleccionado ningún jugador';
}
die();