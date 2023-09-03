<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>
<?="clasificacion/edit.view.php"?>
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
  /* Estilo para el contenedor de la cuadrícula */
  .grid-container {
    display: grid;
    grid-template-columns: repeat(2, 1fr); /* 2 columnas */
    grid-template-rows: repeat(2, 1fr); /* 2 filas */
    grid-gap: 10px; /* Espacio entre elementos */
}

/* Estilo para cada celda de la cuadrícula */
.grid-item {
    padding: 10px;
    border: 1px solid #ccc;
    text-align: center;
}

/* Estilo para los nombres de los equipos */
.team-name {
    font-weight: bold;
}

/* Estilo para los cuadros de texto */
.result-input {
    width: 100%;
    border: none;
    text-align: center;
    font-weight: bold;
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
      <div class="container-fluid mx-4 p-4">
          <label for="nombre" class="block text-sm font-medium leading-6 text-gray-900">Nombre de la liga</label>
          <div class="mt-2">
            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                <input type="text" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                    name="nombre" 
                    id="nombre" 
                    autocomplete="nombre" 
                    required 
                    value="<?=isset($partido['fecha_hora']) ? $partido['fecha_hora'] : "" ?>">
            </div>
          </div>
        </div>




      <label class="form-label my-8">Fecha del partido: </label>
      <input name="fecha_hora" type="date" required value="<?=$fecha?>" class="block flex-1 border border-gray-400 rounded text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6">
      <div class="grid-container mt-6">
        <div class="grid-item">
          <div class="team-name"><?= getNombrebyID($partido['equipo_local_id'], 'EQUIPO'); ?></div>
          <input type="number" min='0' class="result-input block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" name="resultado_local" id="resultado_local" required value="<?=isset($partido['resultado_local']) ? $partido['resultado_local'] : "" ?>">
        </div>
        <div class="grid-item">
          <div class="team-name"><?= getNombrebyID($partido['equipo_visitante_id'], 'EQUIPO'); ?></div>
          <input type="number" min='0' class="result-input block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" name="resultado_visitante" id="resultado_visitante" required value="<?=isset($partido['resultado_visitante']) ? $partido['resultado_visitante'] : "" ?>">
        </div>
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