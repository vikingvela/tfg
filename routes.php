<?php
echo "routes.php/";
echo ($_SERVER['REQUEST_METHOD'].'/');
//dd($_SERVER);
$router->get('/', 'index.php');
$router->get('/about', 'about.php');
$router->get('/contacto', 'contacto.php');
$router->get('/prueba', 'prueba.php');
$router->get('/notificaciones', 'notificaciones.php')->only('auth');
//$router->post('/prueba', 'prueba.php');
$router->get('/prueba', 'prueba.php');

// LIGAS
$router->get('/ligas', 'ligas/index.php');
$router->get('/ligas/create', 'ligas/create.php')->only('gestor');
$router->get('/ligas/register', 'ligas/register.php')->only('auth');
$router->post('/ligas', 'ligas/store.php')->only('auth');

$router->get('/liga/show', 'ligas/show.php');
$router->get('/liga/edit', 'ligas/edit.php')->only('gestor');
$router->delete('/liga', 'ligas/destroy.php')->only('gestor');
$router->patch('/liga', 'ligas/update.php')->only('gestor');


// EQUIPOS
$router->get('/equipos', 'equipos/index.php');
$router->get('/equipos/create', 'equipos/create.php')->only('auth');
$router->post('/equipos', 'equipos/store.php')->only('auth');

$router->get('/equipo/show', 'equipos/show.php');
$router->delete('/equipo', 'equipos/destroy.php')->only('auth');
$router->get('/equipo/edit', 'equipos/edit.php')->only('auth');
$router->patch('/equipo', 'equipos/update.php')->only('auth');

// DEPORTES
$router->get('/deportes', 'deportes/index.php')->only('admin');
$router->get('/deporte', 'deporte/show.php')->only('admin');
$router->delete('/deporte', 'deporte/destroy.php')->only('admin');

$router->get('/deporte/edit', 'deportes/edit.php')->only('admin');
$router->patch('/deportes', 'deportes/update.php')->only('admin');

$router->get('/deportes/create', 'deportes/create.php')->only('admin');
$router->post('/deportes', 'deportes/store.php')->only('admin');


// USUARIOS
$router->get('/usuarios', 'usuarios/index.php');
$router->get('/usuarios/show', 'usuarios/show.php');
$router->get('/usuarios/create', 'usuarios/create.php')->only('guest');
$router->get('/usuarios/edit', 'usuarios/edit.php')->only('auth');
$router->post('/usuarios', 'usuarios/store.php')->only('auth');
$router->post('/usuarios', 'usuarios/update.php')->only('auth');
$router->patch('/usuarios', 'usuarios/update.php')->only('auth');
$router->delete('/usuarios', 'usuario/destroy.php')->only('admin');


$router->get('/register', 'registration/create.php')->only('guest');
$router->post('/register', 'registration/store.php')->only('guest');


// SESIONES
$router->get('/login', 'session/create.php')->only('guest');
$router->post('/session', 'session/store.php')->only('guest');
$router->delete('/session', 'session/destroy.php')->only('auth');