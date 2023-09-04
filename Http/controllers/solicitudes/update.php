<?php
use Core\App;
use Core\Database;

$db = App::resolve(Database::class);
$errors = [];

if (!empty($_POST)) {
  // Solicitudes de jugadores para unirse a equipos
  if($_POST['tipo'] == 'EQUIPO') {
    $tabla = 'SOLICITUDESEQUIPOS';
    $solicitud = $db->query("SELECT id FROM $tabla WHERE usuario_id = :usuario_id and equipo_id = :equipo_id", [
      'usuario_id' => (int)$_POST['usuario_id'],
      'equipo_id' => (int)$_POST['equipo_id']
    ])->find();

    // Se ha pulsado el botón de aprobar
    // Se actualiza el estado de la solicitud a 2 (aprobada)
    // Se crea una nueva entrada en la tabla JUGADOR
    if($_POST['estado'] == "aprobada"){
      $db->updateID($tabla, (int)$solicitud['id'], [
        'estado' => '2'
      ]);
      $db->insert('JUGADOR', [
        'usuario_id' => (int)$_POST['usuario_id'],
        'equipo_id' => (int)$_POST['equipo_id']
      ]);
    } // IF aprobada

    // Se ha pulsado el botón de denegar
    // Se actualiza el estado de la solicitud a 0 (denegada)
     else if ($_POST['estado'] == "denegada"){
      $db->updateID($tabla, (int)$solicitud['id'], [
        'estado' => '0'
      ]);
    } // IF Denegada

    // Crear una notificación para el usuario que realizó la solicitud
    $destino = $db->query("SELECT * FROM EQUIPO WHERE id = :id", [
      'id' => (int)$_POST['equipo_id']
    ])->find();
    $notificacion = $db->query("SELECT id from USUARIO where id=:usuario_id",[
      'usuario_id' => (int)$_POST['usuario_id']
    ])->find();
    redirect('/equipo/show?id=' . $_POST['equipo_id']);
  } // end EQUIPO


  // Solicitudes de equipos para unirse a ligas
  else if ($_POST['tipo'] == 'LIGA') {
    $tabla = 'SOLICITUDESLIGAS';
    $solicitud = $db->query("SELECT id FROM $tabla WHERE equipo_id = :equipo_id and liga_id = :liga_id", [
      'equipo_id' => (int)$_POST['equipo_id'],
      'liga_id' => (int)$_POST['liga_id']
    ])->find();

    // Se ha pulsado el botón de aprobar
    // Se actualiza el estado de la solicitud a 2 (aprobada)
    // Se crea una nueva entrada en la tabla EQUIPOS_LIGAS
    if($_POST['estado'] == (string)"aprobada"){

      $db->updateID($tabla, $solicitud['id'], [
        'equipo_id' => (int)$_POST['equipo_id'],
        'liga_id' => (int)$_POST['liga_id'],
        'estado' => (int)'2'
      ]);
        
      $db->insert('EQUIPOS_LIGAS', [
        'equipo_id' => (int)$_POST['equipo_id'],
        'liga_id' => (int)$_POST['liga_id'],
      ]);

    // Se ha pulsado el botón de denegar
    // Se actualiza el estado de la solicitud a 0 (denegada)
    } else if ($_POST['estado'] == (string)"denegada"){
      $datos = array('estado' => '0');
      $db->updateID($tabla, $solicitud['id'], [
        'estado' => (int)'0'
      ]);
    }
    
    // Crear una notificación para el usuario que realizó la solicitud
    $destino = $db->query("SELECT * FROM LIGA WHERE id = :id", [
        'id' => (int)$_POST['liga_id']          
    ])->find();

    $notificacion = $db->query("SELECT id from EQUIPO where creado_por=:equipo_id",[
        'equipo_id' => (int)$_POST['equipo_id']
    ])->find();
    redirect('/liga/show?id=' . $_POST['liga_id']);
  } // end LIGA
}
  $mensaje = "Tu solicitud para unirte a " .$destino['nombre']. " ha sido " .$_POST['estado'].".";
  //crearNotificacion($notificacion,$mensaje);    


die();