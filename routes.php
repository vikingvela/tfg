<?php

$router->get('/', 'index.php');
$router->get('/about', 'about.php');
$router->get('/contacto', 'contacto.php');
$router->get('/prueba', 'prueba.php');
$router->post('/prueba', 'prueba.php');

$router->get('/ligas', 'ligas/index.php');
$router->get('/liga', 'ligas/show.php');
$router->delete('/liga', 'ligas/destroy.php');

$router->get('/liga/edit', 'ligas/edit.php');
$router->patch('/liga', 'ligas/update.php');

$router->get('/ligas/create', 'ligas/create.php');
$router->post('/ligas', 'ligas/store.php');

$router->get('/deportes', 'deportes/index.php');
$router->get('/deporte', 'deporte/show.php');
$router->delete('/deporte', 'deporte/destroy.php')->only('auth');

$router->get('/deporte/edit', 'deportes/edit.php')->only('auth');
$router->patch('/deporte', 'deportes/update.php')->only('auth');

$router->get('/deportes/create', 'deportes/create.php')->only('auth');
$router->post('/deportes', 'deportes/store.php')->only('auth');

$router->get('/usuarios', 'usuarios/index.php');
$router->get('/usuario', 'usuario/show.php');
$router->delete('/usuario', 'usuario/destroy.php');

$router->get('/usuario/edit', 'usuarios/edit.php');
$router->patch('/usuario', 'usuarios/update.php');

$router->get('/usuarios/create', 'usuarios/create.php');
$router->post('/usuarios', 'usuarios/store.php');

$router->get('/register', 'registration/create.php');//->only('guest');
$router->post('/register', 'registration/store.php');//->only('guest');

$router->get('/login', 'session/create.php');//->only('guest');
$router->post('/session', 'session/store.php');//->only('guest');
$router->delete('/session', 'session/destroy.php');//->only('auth');
