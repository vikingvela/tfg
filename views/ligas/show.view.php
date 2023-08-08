<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>
<?="ligas/show.view.php"?>

<main>
  <div class="border-b border-gray-900/10 pb-12">
    <div class="flex-container flex-col m-5 px-8 py-6 bg-white rounded items-center gap-10">
      <div cover class="mx-2 p-2 border-b border-gray-900/10 pb-12">
        <div liga class="flex justify-between w-full mx-4 p-4 text-5xl">
          <?=isset($liga['nombre']) ? $liga['nombre'] : "" ?>
          <?=isset($liga['logo']) ? $liga['logo'] : "" ?>
        </div>
        <div descripcion class="mx-4 p-4 text-base"><?=isset($liga['descripcion']) ? $liga['descripcion'] : "" ?></div>
        <div fechas class="mx-4 p-4 text-lg">Liga de <?=isset($liga['deporte_id']) ? getNombrebyID($liga['deporte_id'],'DEPORTE') : "deporte" ?> celebrada entre <?=date('d-m-Y', strtotime($liga['fecha_inicio']))?> y <?=date('d-m-Y', strtotime($liga['fecha_fin']))?>.</div>
        <div equipos>
          <div class="mx-4 p-4 text-lg">Equipos participantes:</div>
          <div class="flex justify-between w-full mx-4 p-4 text-5xl">
            <?php foreach($equipos as $equipo): ?>
              <div class="flex flex-col items-center">
                <div class="flex justify-center items-center w-20 h-20 bg-gray-200 rounded-full">
                  <img src="<?=isset($equipo['logo']) ? $equipo['logo'] : "" ?>" alt="Logo del equipo" class="w-16 h-16">
                </div>
                <div class="text-base"><?=isset($equipo['nombre']) ? $equipo['nombre'] : "" ?></div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
      <div clasificacion></div>
      <div resultados></div>
      <!-- Botones -->
      <div class="mt-6 flex items-center justify-end gap-x-6">
        <button type="button" onclick="javascript:history.back()" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Salir</button>
      </div>
    </div>
  </div>
</main>

<?php require base_path('views/partials/footer.php') ?>
