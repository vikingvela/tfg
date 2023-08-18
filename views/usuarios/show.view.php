<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>
<?="usuarios/show.view.php"?>

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
    <div class="flex-container flex-col m-5 px-8 py-6 bg-white rounded items-center gap-10">
        <div cover class="mx-2 p-2">
            <div class="flex-shink-0 max-w h-100"></div><?=isset($usuario['foto']) ? $usuario['foto'] : "" ?></div>
                <div class="flex items-center justify-between w-full mx-4 p-4">
                    <span>
                        Nombre: <?=isset($usuario['nombre']) ? $usuario['nombre'].' '.$usuario['apellido'] : "(Sin nombre)" ?></br>
                        Úlitmo acceso: <?=isset($usuario['ultima_sesion']) ? $usuario['ultima_sesion'] : "(Sin acceso)" ?></br>
                        <?php if (isset($usuarioActual) && (isAdmin($usuarioActual))) : ?> 
                            Correo: <?=isset($usuario['email']) ? $usuario['email'] : "(Sin mail)" ?></br>
                        <?php endif; ?>
                    </span>   
                    <div class="flex-shrink-0 w-64 h-64">
                        <?php if (isset($usuario['foto'])) : ?>
                            <img src="<?= $usuario['foto'] ?>" alt="Imagen de perfil">
                        <?php else : ?>
                            <img class="w-full h-full rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2.2&w=160&h=160&q=80" alt="" />
                        <?php endif; ?>
                    </div>
                </div>
                <div equipos>
                <!-- Listado de equipos participantes -->
                    <div class="container mx-auto px-4 sm:px-8">
                        <div class="py-8">
                            <h2 class="mx-auto text-3xl font-semibold leading-tight">Equipos en los que participa</h2>
                            <div class="my-2 flex sm:flex-row flex-col items-center justify-between">
                                <div class="flex flex-row mb-1 sm:mb-0">
                                    <div class="flex flex-row mb-1 sm:mb-0">
                                        <div class="relative">
                                            <select class="appearance-none h-full rounded-l border block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                                <option>5</option>
                                                <option>10</option>
                                                <option>20</option>
                                            </select>
                                        </div>
                                        <div class="relative">
                                            <select class="appearance-none h-full rounded-r border-t sm:rounded-r-none sm:border-r-0 border-r border-b block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:border-l focus:border-r focus:bg-white focus:border-gray-500">
                                                <option>Todos</option>
                                                <option selected>Activos</option>
                                                <option>Inactivos</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div buscador class="block relative">
                                        <span class="h-full absolute inset-y-0 left-0 flex items-center pl-2"><svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500"><path d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z"></path></svg></span>
                                        <input placeholder="Buscar equipo" class="appearance-none rounded-r rounded-l sm:rounded-l-none border border-gray-400 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none" />
                                    </div>
                                </div>
                                <?php if (isset($usuarioActual) && ($usuario['id'] === $usuarioActual['id'] || isAdmin($usuarioActual))): ?> 
                                    <div btn_crear class="block relative mx-max">
                                        <a href="/usuarios/edit?id=<?=$usuario['id']; ?>" class="rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Editar</a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                                <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                                    <table class="tabla min-w-full leading-normal">
                                        <thead>
                                            <tr>
                                                <th>Equipo</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(isset($equipos)) : 
                                            foreach ($equipos as $equipo) : ?>
                                                <tr>
                                                <td>
                                                    <div class="ml-3">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                        <a href="/equipo/show?id=<?php echo $equipo['id']; ?>" class="text-blue-500 hover:underline"><?=$equipo['nombre'] ?></a>
                                                    </p>
                                                    </div>
                                                </td>
                                                </tr>
                                            <?php endforeach;?>
                                            <?php endif; ?>
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
        </div>
    </div>
</main>

<?php require base_path('views/partials/footer.php') ?>