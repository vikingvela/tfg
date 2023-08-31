<?php

use Core\App;
use Core\Response;
use Core\Database;

function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";

    die();
}

function urlIs($value)
{
    return $_SERVER['REQUEST_URI'] === $value;
}

function abort($code = 404)
{
    http_response_code($code);

    require base_path("views/{$code}.php");

    die();
}

function authorize($condition, $status = Response::FORBIDDEN)
{
    if (! $condition) {
        abort($status);
    }

    return true;
}

function base_path($path)
{
    return BASE_PATH . $path;
}

function view($path, $attributes = [])
{
    extract($attributes);

    require base_path('views/' . $path);
}

function redirect($path)
{
    header("location: {$path}");
    exit();
}

function old($key, $default = '')
{
    return Core\Session::get('old')[$key] ?? $default;
}

function generarConsultaInsert($tabla, $datos){
    
    // Obtener las claves de los datos (nombres de columnas)
    $columnas = array_keys($datos);
    
    // Filtrar los datos para excluir valores vacíos o nulos
    $datosFiltrados = array_filter($datos, function ($valor) {
        return isset($valor) && $valor !== '';
    });
    
    // Construir la consulta de inserción
    $consulta = "INSERT INTO " . $tabla . " (";
    $consulta .= implode(", ", $columnas);
    $consulta .= ") VALUES (";
    
    // Construir los valores de los datos filtrados
    $valores = array_map(function ($valor) {
        // Escapar los valores para evitar ataques de SQL Injection
        return addslashes($valor);
    }, $datosFiltrados);

    // Construir los valores de los datos filtrados

    $consulta .= implode(", ", $valores);
    $consulta .= ")";

    return $consulta;
}

function getUsuarioIDbyEmail($email){
    $db = App::resolve(Database::class);
    $usuarioID = $db->query('SELECT id from USUARIO where email = :email', [
        'email' => $email
    ])->find();
    return $usuarioID['id'];
}
function getbyID($id, $tabla){
 
    $db = App::resolve(Database::class);
    $profile = $db->query('SELECT * from ' .$tabla. ' where id='.$id.'',[
    ])->find();
    
    return $profile;
}

function getperfilbyEmail($email){
    $db = App::resolve(Database::class);
    $profile = $db->query('SELECT * from USUARIO where email = :email',[
        'email' => $email
    ])->find();
    return $profile;
}

function isAdmin($usuario){
    $db = App::resolve(Database::class);
    
    $admin=[];

    if(is_int($usuario)){
        $admin = $db->query('SELECT * from USUARIO where id = :id',[
            'id' => $usuario
        ])->find();
    } else if (is_array($usuario)){
        $admin = $db->query('SELECT * from USUARIO where email = :email',[
            'email' => $usuario['email']
        ])->find();
    } else if (is_string($usuario)){
        $admin = $db->query('SELECT * from USUARIO where email = :email',[
            'email' => $usuario
        ])->find();
    }
    $estado = $admin['estado'];
    $resultado = $estado >= 10 ? true : false;
    return $resultado;
}
function isGestor($usuario){
    $db = App::resolve(Database::class);
    
    if(is_int($usuario)){
        $organizador = $db->query('SELECT * from USUARIO where id = :id',[
            'id' => $usuario
        ])->find();
    } else {
        $organizador = $db->query('SELECT * from USUARIO where email = :email',[
            'email' => $usuario['email']
        ])->find();
    }

    $estado = $organizador['estado'];
    $resultado = $estado >= 3 ? true : false;
    return $resultado;
}

function getNombrebyID($id, $tabla){
    $db = App::resolve(Database::class);
    $nombre = $db->query('SELECT nombre from ' . $tabla . ' where id = :id',[
        'id' => $id
    ])->find();
    return $nombre['nombre'];
}

// Función para enviar una solicitud de acceso a un equipo o liga
function enviarSolicitud($tipo, $idDestino, $idOrigen) {
    // Crea una nueva entrada en la tabla de solicitudes con los detalles
    // Tipo: 'equipo' o 'liga'
    // IdDestino: ID del equipo o liga al que se envía la solicitud
    // IdOrigen: ID del usuario que envía la solicitud, o del equipo que envía la solicitud
    // Puedes guardar la fecha actual aquí también
    $db = App::resolve(Database::class);
    $data = [];
    switch ($tipo) {
        case 'equipo':
            $tabla = 'SOLICITUDESEQUIPOS';
            $data = [
                'jugador_id' => $idDestino,
                'equipo_id' => $idOrigen
            ];
            break;
        case 'liga':
            $tabla = 'SOLICITUDESLIGAS';
            $data = [
                'liga_id' => $idDestino,
                'equipo_id' => $idOrigen
            ];
            break;
        default:
            break;
    }
    $db->insert($tabla, $data);

    // Después de crear la solicitud, puedes notificar al creador del equipo/liga
    // usando una función para crear una notificación en la tabla de notificaciones
    //crearNotificacion($idOrigen, "Tienes una nueva solicitud de acceso.", "solicitud", "/notificaciones");
}



// Función para crear una notificación en la tabla de notificaciones
function crearNotificacion($usuarioId, $mensaje,) {
    $db = App::resolve(Database::class);

    // Inserta una nueva entrada en la tabla de notificaciones con los detalles
    $sql = "INSERT INTO notificaciones (usuario_id, mensaje, tipo, enlace, fecha) 
            VALUES (:usuario_id, :mensaje, :tipo, :enlace, NOW())";
    
    $params = array(
        'usuario_id' => $usuarioId,
        'mensaje' => $mensaje,
    );
    
    $db->insert('NOTIFICACION', $params);
}


function getNotificaciones($usuarioId) {
    // Consulta la tabla de notificaciones filtrando por el usuario
    // Puedes ordenar las notificaciones por fecha descendente para mostrar las más recientes primero
    $db = App::resolve(Database::class);
    $notificaciones = $db->query('SELECT * from NOTIFICACION where id_usuario = :id_usuario ORDER BY fecha DESC',[
        'id_usuario' => $usuarioId
    ])->find();
    // Devuelve un array de notificaciones que el usuario tiene
    return $notificaciones;
}
/*
// Lógica para usar las funciones
$usuarioId = $_SESSION['usuario']['id']; // ID del usuario actualmente logueado

// Enviar una solicitud de acceso a un equipo o liga
enviarSolicitud('equipo', $equipoId, $usuarioId);
enviarSolicitud('liga', $ligaId, $usuarioId);

// Responder a una solicitud
$responderAccion = 'aceptar'; // 'aceptar' o 'rechazar'
responderSolicitud($solicitudId, $responderAccion);

// Obtener las notificaciones del usuario
$notificaciones = getNotificaciones($usuarioId);
*/
