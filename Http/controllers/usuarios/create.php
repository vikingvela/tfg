<?php
/*
    La organización de usuarios se organiza según su estado:
    - 0: Usuario dado de baja
    - 1: Usuario activo, puede iniciar sesión, pero sin datos completados
    - 2: Usuario activo, con datos completados. Puede participar en ligas y equipos
    - 3: Usuario activo, con datos completados y verificados. Puede dar de alta ligas y equipos. Administrar los datos de los equipos que administra y las ligas que administra
    - 10: Usuario administrador, puede dar de alta deportes. También, dministrar todos los datos de la aplicación
*/



view("usuarios/create.view.php", [
    'heading' => 'Crear nuevo usuario',
    'errors' => []
]);