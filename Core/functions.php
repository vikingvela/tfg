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

function isAdmin($user){
    $db = App::resolve(Database::class);
    
    $admin=[];

    if(is_int($user)){
        $admin = $db->query('SELECT * from USUARIO where id = :id',[
            'id' => $user
        ])->find();
    } else if (is_array($user)){
        $admin = $db->query('SELECT * from USUARIO where email = :email',[
            'email' => $user['email']
        ])->find();
    } else if (is_string($user)){
        $admin = $db->query('SELECT * from USUARIO where email = :email',[
            'email' => $user
        ])->find();
    }
    $estado = $admin['estado'];
    $resultado = $estado >= 10 ? true : false;
    return $resultado;
}
function isGestor($user){
    $db = App::resolve(Database::class);
    
    if(is_int($user)){
        $organizador = $db->query('SELECT * from USUARIO where id = :id',[
            'id' => $user
        ])->find();
    } else {
        $organizador = $db->query('SELECT * from USUARIO where email = :email',[
            'email' => $user['email']
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