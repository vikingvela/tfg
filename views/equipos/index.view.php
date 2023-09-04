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
            <!-- Solo para usuarios que administran ligas-->
            <?php if ($equiposAdmin ?? false) : ?> 
            <div class="container bg-green-100 mx-auto px-4 rounded sm:px-8">
                <div class="py-8">
                    <h2 class="mx-auto text-3xl font-semibold leading-tight">Equipos administrados por el usuario</h2>
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
                                        <option>Todas</option>
                                        <option>Activas</option>
                                        <option>Inactivas</option>
                                    </select>
                                </div>
                            </div>
                            <div buscador class="block relative">
                                <span class="h-full absolute inset-y-0 left-0 flex items-center pl-2"><svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500"><path d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z"></path></svg></span>
                                <input placeholder="Buscar liga" class="appearance-none rounded-r rounded-l sm:rounded-l-none border border-gray-400 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none" />
                            </div>
                        </div>
                    </div>
                    <div class="mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                        <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                            <table class="table-auto tabla min-w-full leading-normal">
                                <thead>
                                    <tr>
                                        <th>Equipo</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($equiposAdmin as $equipo) : ?>
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
                                                            <a href="/equipo/show?id=<?php echo $equipo['id']; ?>" class="text-blue-500 hover:underline"><?php echo$equipo['nombre']; ?></a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <?php switch ($equipo['estado']) {
                                                    case '0': 
                                                        echo '
                                                            <span class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
                                                                <span aria-hidden class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
                                                                <span class="relative">Inactivo</span>
                                                            </span>';
                                                    break;
                                                    case '1':
                                                        echo '
                                                            <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                                                <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                                                <span class="relative">Abierto</span>
                                                            </span>';
                                                    break;
                                                    case '2':
                                                        echo '
                                                            <span class="relative inline-block px-3 py-1 font-semibold text-blue-900 leading-tight">
                                                                <span aria-hidden class="absolute inset-0 bg-blue-200 opacity-50 rounded-full"></span>
                                                                <span class="relative">Cerrado</span>
                                                            </span>';
                                                    break;
                                                }?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <!-- EQUIPOS TOTALES -->
        <div class="container mx-auto px-4 sm:px-8">
            <div class="py-8">
                <h2 class="mx-auto text-3xl font-semibold leading-tight">Equipos</h2>
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
                            <div class="relative">
                                <select class="appearance-none h-full rounded-r border-t sm:rounded-r-none sm:border-r-0 border-r border-b block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:border-l focus:border-r focus:bg-white focus:border-gray-500">
                                    <option>Todos</option>
                                    <?php foreach ($deportes as $deporte) echo '<option>'.$deporte['nombre'].'</option>';?>
                                </select>
                            </div>
                        </div>
                        <div buscador class="block relative">
                            <span class="h-full absolute inset-y-0 left-0 flex items-center pl-2"><svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500"><path d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z"></path></svg></span>
                            <input placeholder="Buscar equipo" class="appearance-none rounded-r rounded-l sm:rounded-l-none border border-gray-400 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none" />
                        </div>
                    </div>
                    <?php if (!empty($_SESSION)) : ?> 
                        <div btn_crear class="block relative mx-max">
                            <a href="/equipos/create" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Nuevo</a>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                    <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                        <table class="tabla min-w-full leading-normal">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Liga</th>
                                    <th>Deporte</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($equipos_ligas as $equipo_liga) : ?>
                                    <?php
                                        // Buscar el equipo en el array $equipos
                                        $equipo = null;
                                        foreach ($equipos as $equipo_temp) {
                                            if ($equipo_temp['id'] === $equipo_liga['equipo_id']) {
                                                $equipo = $equipo_temp;
                                                break;
                                            }
                                        }
                                        // Buscar la liga en el array $ligas usando $equipo_liga['liga_id']
                                        $liga_id = $equipo_liga['liga_id'];
                                        $liga = null;
                                        foreach ($ligas as $liga_temp) {
                                            if ($liga_temp['id'] === $liga_id) {
                                                $liga = $liga_temp;
                                                break;
                                            }
                                        }
                                        // Buscar el deporte en el array $deportes
                                        $deporte = null;
                                        foreach ($deportes as $deporte_temp) {
                                            if ($deporte_temp['id'] === $liga['deporte_id']) {
                                                $deporte = $deporte_temp;
                                                break;
                                            }
                                        }
                                    ?>
                                    <tr>
                                        <td>
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 w-10 h-10">
                                                    <?php if (isset($equipo['escudo'])) : ?>
                                                        <img src="<?= $equipo['escudo'] ?>" alt="Logo de la liga">
                                                    <?php else : ?>
                                                        <img class="w-full h-full rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2.2&w=160&h=160&q=80" alt="" />
                                                    <?php endif; ?>
                                                </div>
                                                <div class="ml-3">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                        <a href="/equipo/show?id=<?php echo $equipo['id']; ?>" class="text-blue-500 hover:underline"><?=$equipo['nombre'] ?></a>
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="ml-3">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    <a href="/liga/show?id=<?php echo $liga['id']; ?>" class="text-blue-500 hover:underline"><?= $liga['nombre'] ?></a>
                                                </p>
                                            </div>
                                        </td>
                                        <td><?= $deporte['nombre'] ?></td>
                                        <td><?php
                                            switch ($liga['estado']) {
                                                case '0': 
                                                    echo '
                                                        <span class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
                                                            <span n class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
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
                                                            <span class="relative">Activa</span>
                                                        </span>';
                                                break;
                                            }?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between">
                        <span class="text-xs xs:text-sm text-gray-900">
                            Páginas
                        </span>
                        <div class="inline-flex mt-2 xs:mt-0">
                            <button class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-l">
                                Anterior
                            </button>
                            <button class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-r">
                                Siguiente
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</main>

<?php require base_path('views/partials/footer.php') ?>
