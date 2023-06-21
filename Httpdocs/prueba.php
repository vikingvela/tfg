<?php
use Core\App;
use Core\Validator;
use Core\Database;

$db = App::resolve(Database::class);

dd($_SESSION);

$nombre = $_POST['nombre'];
if (isset($_POST['logo']) ? $logo = $_POST['logo'] : $logo = null);
if (isset($_POST['cover']) ? $cover = $_POST['cover'] : $cover = null);
$creado_por = getUsuarioIDbyEmail($_POST['usuario']);
echo 'sesion';
//dd($creado_por);
echo 'sesion';