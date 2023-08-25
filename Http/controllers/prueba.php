<?php

use Core\App;
use Core\Database;

echo "PRUEBA/index.php";

$db = App::resolve(Database::class);

$ligas = $db->query('SELECT * FROM LIGA')->get();
$ligas_equipo = $db->query('SELECT * FROM EQUIPOS_LIGAS')->get();
$deportes = $db->query('SELECT * from DEPORTE')->get();

$ligasAdmin = [];

if(!empty($_SESSION)) {
    $usuarioID = getUsuarioIDbyEmail($_SESSION['usuario']['email']);
    if(isGestor($usuarioID)) {
        $ligasAdmin = array_filter($ligas, function($liga) use ($usuarioID) {
            return $liga['creado_por'] == $usuarioID;
        });
    }
}


// por cada liga del equipo en $ligas_equipo busco la liga en la tabla liga y lo guardo en $ligas
foreach ($ligas as &$liga) {
    foreach ($deportes as $deporte) {
        if ($deporte['id'] === $liga['deporte_id']) {
            $liga['deporte'] = $deporte['nombre'];
            break;
        }        
    }
}
unset($liga, $deporte);
//dd($ligas);
/*
$campo = $_POST['campo'] ?? null;
$tabla ='';
foreach ($ligas as $liga) { /register.php?liga_id='.$liga['id'].'
    $tabla.='<tr>';
    $tabla.='<td>';
    $tabla.='<div class="flex items-center">';
    $tabla.='<div class="flex-shrink-0 w-10 h-10">';
    if(isset($liga['logo'])) $tabla.='<img src="'.$liga['logo'].'" alt="Logo de la liga">';
    else $tabla.='<img class="w-full h-full rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2.2&w=160&h=160&q=80" alt="" />';
    $tabla.='</div>';
    $tabla.='<div class="ml-3">';
    $tabla.='<p class="text-gray-900 whitespace-no-wrap">';
    $tabla.='<a href="/liga/edit?id='.$liga['id'].'" class="text-blue-500 hover:underline">'.$liga['nombre'].'</a>';
    $tabla.='</p>';
    $tabla.='</div></div></td><td>'.$liga['deporte'].'</td>';
    $tabla.='<td><p class="text-gray-900 whitespace-no-wrap">.'.date('d-m-Y', strtotime($liga['fecha_inicio'])).'</p>';
    $tabla.='</td><td>'.$liga['estado'].'</td></tr>';
}
//echo json_encode($tabla, JSON_UNESCAPED_UNICODE);
*/

    // Filtrar ligas por estado
    $estadoFiltro = isset($_GET['estado']) ? $_GET['estado'] : 'Todas';
    if ($estadoFiltro !== 'Todas') {
        $ligasFiltradas = array_filter($ligas, function($liga) use ($estadoFiltro) {
            return $liga['estado'] === $estadoFiltro;
        });
    } else {
        $ligasFiltradas = $ligas;
    }

//dd($ligasFiltradas);
view("/prueba.view.php", [
    'heading' => 'PRUEBA',
    'ligas' => $ligasFiltradas,
    'ligasAdmin' => $ligasAdmin,
    'estadoFiltro' => $estadoFiltro,
    'deportes' => $deportes
]);
