<?php

use Illuminate\Contracts\Support\CanBeEscapedWhenCastToString;

 require base_path('views/partials/head.php') ?>
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
</style>

<main>
  <div class="border-b border-gray-900/10 pb-12">
    <div class="flex-container flex-col m-5 px-8 py-6 bg-white rounded items-center gap-10">
      <div cover class="mx-2 p-2 flex-items auto">
        <div class="flex items-center justify-between w-full mx-4 p-4 text-xl">
          <?=$liga['nombre']?>
        </div>
        <div fechas class="mx-4 p-4 text-lg">Deporte de la liga: <?=isset($liga['deporte_id']) ? getNombrebyID($liga['deporte_id'],'DEPORTE') : "deporte" ?></div>
          <form action="/clasificacion" method="POST" enctype="multipart/form-data">            
            <input type="hidden" id="liga" name="liga" value='<?= $liga['id']; ?>'>
            <div class="block text-sm font-medium leading-6 text-gray-900">
              <li>Si el número de equipos es IMPAR, cada jornada habrá un equipo que descanse y no es emparejado con nadie</li>
              <li>Las jornadas se generan todas para el día de inicio con el fin de que puedan colocarse manualmente en la fecha deseada. Esta fecha podrá cambiarse más adelante si el calendario se ve alterado por cualquier razón</li>
              <li>Una vez generado el calendario y la clasificación, no se podrá alterar, ni agregar equipos nuevos a la competición</li>
              <li>La liga genera las jornadas de: 
                <input type="radio" name="idayvuelta" value="0"> Sólo ida
                <input type="radio" name="idayvuelta" value="1" checked> Ida y vuelta
              </li>
            </div>
            <div class="mt-6 flex items-center justify-end gap-x-6">
              <button type="button" onclick="javascript:history.back()" class="rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Salir</button>
              <button type="submit" class="rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">Generar liga</button>
            </div>
          </form>         
        </div>
      </div>
    </div>
  </div>
</main>

<?php require base_path('views/partials/footer.php') ?>
