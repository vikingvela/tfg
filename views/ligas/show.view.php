<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>

<style>
    .tabla {
    width: 100%;
    border-collapse: collapse;
    /* otros estilos */
    }

    .tabla th {
        padding: 0.75rem 1.25rem; /* px-5 py-3 */
        border-bottom-width: 2px; /* border-b-2 */
        border-color: #E5E7EB; /* border-gray-200 */
        background-color: #F3F4F6; /* bg-gray-100 */
        text-align: left; /* text-left */
        font-size: 0.75rem; /* text-xs */
        font-weight: 600; /* font-semibold */
        color: #4B5563; /* text-gray-600 */
        letter-spacing: 0.05em; /* tracking-wider */
        text-transform: uppercase; /* uppercase */
    }
    /* Estilos para las celdas <td> */
    .tabla td {
        padding: 1.25rem; /* px-5 py-5 */
        border-bottom-width: 1px; /* border-b */
        border-color: #E5E7EB; /* border-gray-200 */
        background-color: #FFFFFF; /* bg-white */
        font-size: 0.875rem; /* text-sm */
        color: #4A5568; /* text-gray-700 */
    }
    .jornada {
    cursor: pointer;
    padding: 0.75rem 1.25rem; /* px-5 py-3 */
    border-bottom-width: 2px; /* border-b-2 */
    border-color: #E5E7EB; /* border-gray-200 */
    background-color: #F3F4F6; /* bg-gray-100 */
    text-align: left; /* text-left */
    font-size: 0.75rem; /* text-xs */
    font-weight: 600; /* font-semibold */
    color: #4B5563; /* text-gray-600 */
    letter-spacing: 0.05em; /* tracking-wider */
    text-transform: uppercase; /* uppercase */
  }

  .partidos {
    display: none;
    padding: 1.25rem; /* px-5 py-5 */
    border-bottom-width: 1px; /* border-b */
    border-color: #E5E7EB; /* border-gray-200 */
    background-color: #FFFFFF; /* bg-white */
    font-size: 0.875rem; /* text-sm */
    color: #4A5568; /* text-gray-700 */
  }
</style>

<script>
  function togglePartidos(jornada) {
    var partidos = document.getElementById('jornada' + jornada);
    if (partidos.style.display === 'block') {
      partidos.style.display = 'none';
    } else {
      partidos.style.display = 'block';
    }
  }
</script>

<main>
  <div class="border-b border-gray-900/10 pb-12">
    <div class="flex-container flex-col m-5 px-8 py-6 bg-white rounded items-center gap-10">
      <div cover class="mx-2 p-2 flex-items auto">
        <?php if(isset($liga['admin'])) :?>
          <button type="button" onclick="window.location.href = '/liga/edit?id=<?php echo $liga['id']; ?>';" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Editar datos</button>
            <?php if($liga['estado']=='1'){ ?>
            <button type="button" onclick="window.location.href = '/clasificacion/create?id=<?php echo $liga['id']; ?>';" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Comenzar liga</button>
            <?php } ?>
            <?php endif; ?>
        <div class="flex-shink-0 max-w h-100"></div><?=isset($liga['cover']) ? $liga['cover'] : "" ?></div>
        <div class="flex items-center justify-between w-full mx-4 p-4 text-5xl">
          <?=isset($liga['nombre']) ? $liga['nombre'] : "" ?>
          <div class="flex-shrink-0 w-64 h-64">
            <?php if (isset($liga['logo'])) : ?>
              <img src="<?= $liga['logo'] ?>" alt="Logo de la liga">
            <?php else : ?>
              <img class="w-full h-full rounded-full" src="https://img.freepik.com/vector-premium/logotipo-futbol-logotipo-futbol-logotipo-equipo-deportivo-vectortemplate_1195-968.jpg?w=826" alt="" />
            <?php endif; ?>
          </div>
        </div>
        <div descripcion class="mx-4 p-4 text-base"><?=isset($liga['descripcion']) ? $liga['descripcion'] : "" ?></div>
        <div fechas class="mx-4 p-4 text-lg">Liga de <?=isset($liga['deporte_id']) ? getNombrebyID($liga['deporte_id'],'DEPORTE') : "deporte" ?> celebrada entre <?=date('d-m-Y', strtotime($liga['fecha_inicio']))?> y <?=date('d-m-Y', strtotime($liga['fecha_fin']))?>.</div>
        <div equipos>
          <!-- Listado de equipos participantes -->
          <div class="container mx-auto bg-gren-100 rounded">
            <div class="py-8">
              <div class="sm:mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                  <table class="tabla min-w-full leading-normal">
                    <thead>
                      <tr>
                        <th>Equipos participantes</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($equipos as $equipo) : ?>
                        <tr>
                          <td>
                            <div class="flex items-center">
                              <div class="flex-shrink-0 w-10 h-10">
                                <?php if (isset($equipo['escudo'])) : ?>
                                  <img src="<?= $equipo['escudo'] ?>" alt="Escudo del equipo">
                                <?php else : ?>
                                  <img class="w-full h-full rounded-full" src="https://www.shutterstock.com/shutterstock/photos/2126440532/display_1500/stock-vector-soccer-team-emblem-logo-design-vector-illustration-2126440532.jpg" alt="" />
                                <?php endif; ?>
                              </div>
                              <div class="ml-3">
                                <p class="text-gray-900 whitespace-no-wrap">
                                  <a href="/equipo/show?id=<?=$equipo['equipo_id']; ?>" class="text-blue-500 hover:underline"><?=getNombrebyID($equipo['equipo_id'],'EQUIPO');?></a>
                                </p>
                              </div>
                            </div>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <?php if($liga['estado']=='1' & isset($liga['admin']) & !empty($solicitudes)){ ?>
              <div class="sm:-mx-8 sm:px-8 py-4 overflow-x-auto">
                  <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                    <table name=solicitudes class="tabla min-w-full leading-normal">
                      <thead>
                        <tr>
                          <th>Solicitudes pendientes de equipos</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($solicitudes as $solicitud) : ?>
                          <tr>
                            <td>
                              <div class="flex items-center">
                                <div class="flex-shrink-0 w-10 h-10">
                                  <?php if (isset($solicitud['escudo'])) : ?>
                                    <img src="<?= $solicitud['escudo'] ?>" alt="Escudo del equipo">
                                  <?php else : ?>
                                    <img class="w-full h-full rounded-full" src="https://www.shutterstock.com/shutterstock/photos/2126440532/display_1500/stock-vector-soccer-team-emblem-logo-design-vector-illustration-2126440532.jpg" alt="" />
                                  <?php endif; ?>
                                </div>
                                <div class="ml-3">
                                  <p class="text-gray-900 whitespace-no-wrap">
                                    <a href="/equipo/show?id=<?=$solicitud['id']; ?>" class="text-blue-500 hover:underline"><?=getNombrebyID($solicitud['id'],'EQUIPO');?></a>
                                  </p>
                                </div>
                              </div>
                            </td>
                            <td class="flex items-center space-x-2">
                                <form action="/solicitudes/update" method="POST" enctype="multipart/form-data">
                                  <button type="submit" class="rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">Aceptar</button>
                                  <input type="hidden" id="destino_id" name="liga_id" value="<?=$liga['id']?>">
                                  <input type="hidden" id="origen_id" name="equipo_id" value="<?=$solicitud['id']?>">
                                  <input type="hidden" id="tipo" name="tipo" value="LIGA">
                                  <input type="hidden" id="estado" name="estado" value="aprobada">                                  
                                </form>
                                <form action="/solicitudes/update" method="POST" enctype="multipart/form-data">
                                  <button type="submit" class="rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">Denegar</button>
                                  <input type="hidden" id="destino_id" name="liga_id" value="<?=$liga['id']?>">
                                  <input type="hidden" id="origen_id" name="equipo_id" value="'.$solicitud['id'].'">
                                  <input type="hidden" id="tipo" name="tipo" value="LIGA">
                                  <input type="hidden" id="estado" name="estado" value="denegada">                                  
                                </form>
                              </td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              <?php } ?>
          </div>
          <div clasificacion>
            <table class="tabla min-w-full leading-normal">
              <tr>
                <th>Equipo</th>
                <th>Puntos</th>
                <th>PJ</th>
                <th>PG</th>
                <th>PE</th>
                <th>PP</th>
                <th>GF</th>
                <th>GC</th>
                <th>Dif</th>
              </tr>
              <?php foreach ($clasificaciones as $clasificacion) : ?>
                <tr>
                  <td>Equipo <?= $clasificacion['nombre']['nombre'] ?></td>
                  <td><?= $clasificacion['puntos'] ?></td>
                  <td><?= $clasificacion['pj'] ?></td>
                  <td><?= $clasificacion['pg'] ?></td>
                  <td><?= $clasificacion['pe'] ?></td>
                  <td><?= $clasificacion['pp'] ?></td>
                  <td><?= $clasificacion['gf'] ?></td>
                  <td><?= $clasificacion['gc'] ?></td>
                  <td><?= $clasificacion['dif'] ?></td>
                </tr>
              <?php endforeach; ?>
            </table>
          </div>
          <div jornadas>
          <?php
          // Tu array de jornadas
            foreach ($jornadas as $jornada) {
              $numJornada = $jornada['numero'];
              $fechaJornada = date('d-m-Y', strtotime($jornada['fecha_inicio']))." - ".date('d-m-Y', strtotime($jornada['fecha_fin']));
              // Ajusta el número de jornada para que comience en 1
              echo '<div class="sm:px-1 py-4 overflow-x-auto">';
              echo '<div class="inline-block min-w-full shadow rounded-lg overflow-hidden">';
              echo "<div class='jornada' onclick='togglePartidos($numJornada)'>Jornada $numJornada ($fechaJornada)</div>";
              echo "<div class='partidos' id='jornada$numJornada'>";
              foreach ($jornada['partidos'] as $partido) {
                $equipoA = getNombrebyID($partido['equipo_local_id'], 'EQUIPO');
                $equipoB = getNombrebyID($partido['equipo_visitante_id'], 'EQUIPO');
                if(isset($partido['resultado_local'])){
                  $resultado = $partido['resultado_local'] . " - " . $partido['resultado_visitante'];
                } else {
                  $resultado = "(Pendiente)";
                }
                $fecha = date('d-m-Y', strtotime($partido['fecha_hora']));                
                echo "<p>$equipoA vs $equipoB - Resultado: $resultado - Fecha: $fecha ";
                if(isset($liga['admin']) && empty($partido['estado']))
                echo "<button type='button' onclick=\"window.location.href = '/clasificacion/edit?id={$partido['id']}';\" class='my-2 rounded-md bg-indigo-600 px-1 py-1 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600'>Editar</button>";
              }
              echo "</p></div></div></div>";
            }
          ?>       
          </div>
          <div class="mt-6 flex items-center justify-end gap-x-6">
            <button type="button" onclick="javascript:history.back()" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Salir</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<?php require base_path('views/partials/footer.php') ?>
