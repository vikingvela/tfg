<?php

use Core\App;
use Core\Response;

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

function generarConsultaInsert($tabla, $datos)
{
    // Obtener las claves de los datos (nombres de columnas)
    $columnas = array_keys($datos);

    // Filtrar los datos para excluir valores vacíos o nulos
    $datosFiltrados = array_filter($datos, function ($valor) {
        return isset($valor) && $valor !== '';
    });

    // Construir la consulta de inserción
    $consulta = "INSERT INTO " . $tabla . " (";
    $consulta .= implode(", ", array_keys($datosFiltrados));
    $consulta .= ") VALUES (";

    // Construir los valores de los datos filtrados
    $valores = array_map(function ($valor) {
        // Escapar los valores para evitar ataques de SQL Injection
        return "'" . addslashes($valor) . "'";
    }, $datosFiltrados);

    $consulta .= implode(", ", $valores);
    $consulta .= ")";

    return $consulta;
}

function getUsuarioIDbyEmail($email){

    $usuario = App::resolve(Database::class)->query('select * from USUARIO where email = :email')->find();
    $usuario->execute(['email' => $email]);
    $resultado = $usuario->fetch(PDO::FETCH_ASSOC);
    dd($resultado['id']); // ID del usuario obtenido de la consulta

    /*
    if ($resultado) {
        $idUsuario = $resultado['id']; // ID del usuario obtenido de la consulta
    
        // Paso 2: Insertar el registro en la tabla deseada
        $query = $db->prepare('INSERT INTO tabla (id_usuario, otro_campo) VALUES (:idUsuario, :otroCampo)');
        $query->execute([
            'idUsuario' => $idUsuario,
            'otroCampo' => 'valor_otro_campo'
        ]);
    
        // Si todo fue exitoso, se ha insertado el registro en la base de datos
        echo 'Registro insertado correctamente.';
    } else {
        // No se encontró ningún usuario con el correo electrónico proporcionado
        echo 'Usuario no encontrado.';
    }
    */

}
