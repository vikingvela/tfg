<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>
<?="equipos/edit.view.php"?>

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
      <form action="/equipos" method="POST" enctype="multipart/form-data">
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
        <!-- Escudo -->   
        <div class="container-fluid mx-4 p-4">
          <label class="block text-sm font-medium leading-6 text-gray-900">Escudo</label>
          <div class="mt-2 flex items-center gap-x-3">
            <svg for="escudo" class="h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" clip-rule="evenodd" />
            </svg>
            <input type="file" id="escudo" name="escudo" class="sr-only">
            <label for="escudo" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
            <span class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Subir</span>
          </div>
        </div>
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
          </div>
        </div>        
        <!-- Comprueba que $ligas no esté vacío -->
        <?php if(!empty($ligas)) :?>
          <p>
            <h2 class="py-8 mx-auto text-3xl font-semibold leading-tight">Ligas en las que participa el equipo</h2>
          </p>
          <?php foreach($ligas as $liga) :?>
            <div class="container mx-auto px-4 rounded sm:px-8">
              <div class="py-8">
                <div class="flex flex-col my-2">
                  <div class="flex justify-between items-center text-xl mb-1">
                    <h4 class="font-semibold leading-tight"><?=$liga['nombre'].' ('.$liga['deporte'].')'?></h4>
                    <div class="flex flex-column items-center">
                        <select class="appearance-none h-full rounded border-t sm:rounded-r-none sm:border-r-0 border-r border-b block appearance-none bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:border-l focus:border-r focus:bg-white focus:border-gray-500">
                          <option>Todos</option>
                          <option>Activos</option>
                          <option>Inactivos</option>
                          <option>Invitados</option>
                        </select>
                        <div buscador class="block relative mx-auto sm:border-l-0 sm:border-r-0 border-r">
                          <span class="h-full absolute inset-y-0 left-0 flex items-center pl-2"><svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500"><path d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z"></path></svg></span>
                          <input placeholder="Invitar @email jugador" class="appearance-none border border-gray-400 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none" />
                        </div>
                        <div btn_crear class="block relative mx-max">
                          <a href="/ligas/create" class="rounded rounded-l-none border-0 border-l-0 border-gray-400 bg-indigo-600 px-6 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Invitar</a>
                        </div>
                      </div>
                  </div>
                </div>
                <div class="mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                  <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                    <table class="tabla min-w-full leading-normal">
                      <thead>
                        <tr>
                          <th>Jugador</th>
                          <th>Estado</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if(!empty($liga['jugadores'])) :?>
                          <?php foreach ($liga['jugadores'] as $jugador) : ?>
                            <tr>
                              <td>
                                <p class="text-gray-900 whitespace-no-wrap">
                                  <a href="/usuario/show?id=<?php echo $jugador['id']; ?>" class="text-blue-500 hover:underline"><?php echo $jugador['nombre']; ?></a>
                                </p>
                              </td>
                              <td>
                                <?php switch ($jugador['estado']) {
                                  case '0': 
                                    echo '
                                      <span class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
                                        <span aria-hidden class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
                                        <span class="relative">Terminada</span>
                                      </span>';
                                  break;
                                  case '1':
                                    echo '
                                      <span class="relative inline-block px-3 py-1 font-semibold text-orange-900 leading-tight">
                                        <span aria-hidden class="absolute inset-0 bg-orange-200 opacity-50 rounded-full"></span>
                                        <span class="relative">Inactiva</span>
                                      </span>';
                                  break;
                                  default:
                                    echo '
                                      <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                        <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                        <span class="relative">Activo</span>
                                      </span>';
                                  break;
                                }?>
                              </td>
                            </tr>
                          <?php endforeach; ?>
                        <?php endif; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
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