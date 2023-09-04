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
  <div class="">
    <div class="m-5 px-8 py-6 bg-white rounded grid">      
      <form action="/equipo" method="POST" enctype="multipart/form-data">
        <!-- Otras variables -->
        <input type="hidden" name="_method" value="PATCH">
        <input type="hidden" name="id" value="<?= $equipo['id'] ?>">  
        <!-- Nombre del equipo -->
        <div class="container-fluid mx-4 p-4"> 
          <label for="nombre" class="block text-sm font-medium leading-6 text-gray-900">Nombre del equipo</label>
          <div class="mt-2">
            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                <input class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                    type="text"
                    name="nombre"
                    id="nombre"
                    autocomplete="nombre"
                    required
                    value="<?=isset($equipo['nombre']) ? $equipo['nombre'] : "" ?>">
                <?php if (isset($errors['nombre'])) : ?><p class="text-red-500 text-xs mt-2"><?= $errors['nombre'] ?></p><?php endif; ?>
            </div>
          </div>
        </div>
        <!-- Formulario para modificar el Escudo -->
        <form action="upload.php" method="post" enctype="multipart/form-data">
          <div class="container-fluid mx-4 p-4">
            <label class="block text-sm font-medium leading-6 text-gray-900">Escudo</label>
            <div class="mt-2 flex items-center gap-x-3">
              <input type="file" name="escudo" id="escudo" class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
              <input type="submit" value="Subir" name="submit"></input>
            </div>
          </div>
        </form> 
        <!-- Portada -->
        <div class="container-fluid mx-4 p-4 border-b border-gray-900/10 pb-12">
          <label for="cover" class="block text-sm font-medium leading-6 text-gray-900">Foto de portada</label>
            <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
              <div class="text-center">
                <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" />
                </svg>
                <div class="mt-4 flex text-sm leading-6 text-gray-600">
                  <label for="cover" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                    <span>Subir portada</span>
                    <input id="cover" name="cover" type="file" class="sr-only">
                  </label>
                  <p class="pl-1">o arrastra y suelta hasta aquí</p>
                </div>
                <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF hasta 10MB</p>
              </div>              
          </div><br>
          <?php if ($equipo['estado']!=0): ?>
            <div class="block text-sm font-medium leading-6 text-gray-900">
              <label for="estado" >Permite que los jugadores soliciten acceso:</label><br>
              Sí <input type="radio" name="estado" value="1" <?php if ($equipo['estado'] === 1) echo 'checked'; ?>>
              - <input type="radio" name="estado" value="2" <?php if ($equipo['estado'] === 2) echo 'checked'; ?>> No
            </div>
          <?php endif; ?>
        </div>
        <!-- Botones -->
        <div class="mt-6 flex items-center justify-end gap-x-6">
          <button type="button" onclick="javascript:history.back()" class="text-sm font-semibold leading-6 text-gray-900">Cancelar</button>
          <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</body>
</main>

<?php require base_path('views/partials/footer.php') ?>