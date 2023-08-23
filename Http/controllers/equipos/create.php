<?php

echo "equipos/create.php";
/*
    Según el 'estado' del equipo su comportamiento es diferente:
    - 0: Equipo inactivo, no se puede invitar a jugadores al equipo
    - 1: Equipo activo, el creador puede invitar a jugadores y puede inscribir al equipo en ligas
    - 2: Equipo en liga, el creador puede invitar a jugadores y puede inscribir al equipo en más ligas
*/

view("equipos/create.view.php", [
    'heading' => 'Crear equipo nuevo',
    'errors' => []
]);