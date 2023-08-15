<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>
<?="ligas/show.view.php"?>

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
</style>

<main>
  <div class="border-b border-gray-900/10 pb-12">
    <div class="flex-container flex-col m-5 px-8 py-6 bg-white rounded items-center gap-10">
      <div cover class="mx-2 p-2">
       <div class="flex-shink-0 max-w h-100"></div><?=isset($liga['cover']) ? $liga['cover'] : "" ?></div>
        <div class="flex items-center justify-between w-full mx-4 p-4 text-5xl">
          <?=isset($liga['nombre']) ? $liga['nombre'] : "" ?>
          <div class="flex-shrink-0 w-64 h-64">
            <?php if (isset($liga['logo'])) : ?>
              <img src="<?= $liga['logo'] ?>" alt="Logo de la liga">
            <?php else : ?>
              <img class="w-full h-full rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2.2&w=160&h=160&q=80" alt="" />
            <?php endif; ?>
          </div>
        </div>
        <div descripcion class="mx-4 p-4 text-base"><?=isset($liga['descripcion']) ? $liga['descripcion'] : "" ?></div>
        <div fechas class="mx-4 p-4 text-lg">Liga de <?=isset($liga['deporte_id']) ? getNombrebyID($liga['deporte_id'],'DEPORTE') : "deporte" ?> celebrada entre <?=date('d-m-Y', strtotime($liga['fecha_inicio']))?> y <?=date('d-m-Y', strtotime($liga['fecha_fin']))?>.</div>
        <div equipos>
          <!-- Listado de equipos participantes -->
          <div class="container mx-auto px-4 bg-gren-100 rounded sm:px-8">
            <div class="py-8">
              <div class="mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
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
                                  <img class="w-full h-full rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2.2&w=160&h=160&q=80" alt="" />
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
          </div>
          <div class="mt-6 flex items-center justify-end gap-x-6">
            <button type="button" onclick="javascript:history.back()" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Salir</button>
          </div>
        </div>
      </div>
      <div clasificacion></div>
      <div resultados></div>
      <!-- Botones -->
    </div>
  </div>
</main>

<?php require base_path('views/partials/footer.php') ?>
