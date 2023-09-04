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
</style>

<main>
<body class="antialiased font-sans bg-gray-200">
  <div class="m-5 px-8 py-6 bg-white rounded grid">
    <form action="/clasificacion" method="POST" enctype="multipart/form-data">
      <!-- Otras variables -->
      <input type="hidden" name="_method" value="PATCH">
      <input type="hidden" name="id" value="<?= $partido['id'] ?>">
      <input type="hidden" name="jornada_id" value="<?= $jornada['id'] ?>">
      <input type="hidden" name="liga_id" value="<?= $liga['id'] ?>"> 
      <!-- Nombre del equipo -->
      <div class="flex">
          <label class="mx-4 text-gray-500">Fecha del partido</label>
      </div>
      <input name="fecha_hora" type="date" required value="<?= $liga['fecha_inicio']?>" class="block m-4 flex-1 border border-gray-400 rounded text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6">
      
      <div class="flex container flex-auto items-center space-between my-4">
        <label class="mx-4 text-gray-500">Puntuación equipo local</label>
        <input type="number" min='0' class="rounded" name="resultado_local" id="resultado_local" required 
          value="<?php if(isset($partido['resultado_local'])) echo $partido['resultado_local']; else echo ''; ?>">
      </div>
      <div class="flex container flex-auto items-center space-between my-4">
        <label class="mx-4 text-gray-500">Puntuación equipo visitante</label>
        <input type="number" min='0' class="rounded" name="resultado_visitante" id="resultado_visitante" required 
          value="<?php if(isset($partido['resultado_visitante'])) echo $partido['resultado_visitante'];?>">
      </div>
      <!-- Botones -->
      <div class="mt-6 flex items-center justify-end gap-x-6">
        <button type="button" onclick="javascript:history.back()" class="text-sm font-semibold leading-6 text-gray-900">Cancelar</button>
        <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Guardar</button>
      </div>
      
    </form>
  </div>
</body>
</main>

<?php require base_path('views/partials/footer.php') ?>