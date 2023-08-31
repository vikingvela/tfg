<?php
use Core\App;
use Core\Database;
echo "solicitudes/store.php";
$db = App::resolve(Database::class);
$errors = [];

// SOLICITUDES LIGAS
if (!empty($_POST['liga_id'])) {
  $db->insert('solicitudesLigas', [
    'liga_id' => (int)$_POST['liga_id'],
    'equipo_id' => (int)$_POST['equipo_id']
  ]);
  redirect('/solicitudes/ligas?id=' . (int)$_POST['equipo_id']);
} else {
  $errors['liga_id'] = 'No se ha seleccionado ninguna liga';
}

// SOLICITUDES EQUIPOS
if (!empty($_POST['equipo_id'])) {
  $db->insert('solicitudesEquipos', [
    'usuario_id' => (int)$_POST['usuario_id'],
    'equipo_id' => (int)$_POST['equipo_id']
  ]);
  redirect('/solicitudes/equipos?id=' . (int)$_POST['usuario_id']);
} else {
  $errors['equipo_id'] = 'No se ha seleccionado ningún jugador';
}
die();