<?php

/*
    Según el 'estado' del equipo su comportamiento es diferente:
    - 0: Equipo inactivo, no se pueden unir jugadores al equipo
    - 1: Equipo activo, los usuarios pueden inscribirse al equipo y se puede inscribir al equipo en ligas
    - 2: Equipo activo, los usuarios NO pueden inscribirse al equipo y se puede inscribir al equipo en más ligas

*/

view("equipos/create.view.php", [
    'heading' => 'Crear equipo nuevo',
    'errors' => []
]);