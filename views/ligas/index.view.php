<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>
<?="ligas/index.view.php"?>

<main>
<body class="antialiased font-sans bg-gray-200">
    <div class="m-5 px-8 py-6 bg-white rounded grid">
        <!-- Solo para usuarios que administran ligas-->
        <?php if ($ligasAdmin ?? false) : ?> 
            <div class="container mx-auto px-4 bg-gren-100 rounded sm:px-8">
                <div class="py-8">
                    <h2 class="mx-auto text-3xl font-semibold leading-tight">Ligas administradas por el usuario</h2>
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
                        <?php if (isGestor($_SESSION['usuario'])){ ?> 
                            <div btn_crear class="block relative mx-max">
                                <a href="/ligas/create" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Nueva</a>
                            </div>
                        <?php }?>
                    </div>
                    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                        <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                            <table class="min-w-full leading-normal">
                                <thead>
                                    <tr>
                                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Liga</th>
                                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Deporte</th>
                                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Fecha inicio
                                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Fecha fin</th>
                                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($ligasAdmin as $liga) : ?>
                                        <tr>
                                            <td logo class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 w-10 h-10">
                                                    <?php if (isset($liga['logo'])) : ?>
                                                        <img src="<?= $liga['logo'] ?>" alt="Logo de la liga">
                                                    <?php else : ?>
                                                        <img class="w-full h-full rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2.2&w=160&h=160&q=80" alt="" />
                                                    <?php endif; ?>
                                                </div>
                                                <div class="ml-3">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    <a href="/liga/edit?id=<?php echo $liga['id']; ?>" class="text-blue-500 hover:underline"><?php echo $liga['nombre']; ?></a>
                                                </p>
                                                </div>
                                            </div>
                                            </td>
                                            <td nombre_liga class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <?php foreach ($deportes as $deporte) {
                                                    if ($deporte['id'] === $liga['deporte_id']) {
                                                        echo $deporte['nombre'];break;
                                                    }
                                                }?>
                                            </td>
                                            <td fecha_inicio class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <p class="text-gray-900 whitespace-no-wrap"><?=date('d-m-Y', strtotime($liga['fecha_inicio']))?></p>
                                            </td>
                                            <td fecha_fin class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <p class="text-gray-900 whitespace-no-wrap"><?=date('d-m-Y', strtotime($liga['fecha_fin']))?></p>
                                            </td>
                                            <td estado class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <?php foreach ($ligas as $liga) {
                                                    switch ($liga['estado']) {
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
                                                    }
                                                }?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between          ">
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
        <?php endif; ?>    
        <!-- Listado de ligas total -->
        <div class="container mx-auto px-4 sm:px-8">
            <div class="py-8">
                <div>
                    <h2 class="mx-auto text-3xl font-semibold leading-tight">Ligas</h2>
                </div>
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
                <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                    <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                        <table class="min-w-full leading-normal">
                            <thead>
                                <tr>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Liga
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Deporte
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Fecha inicio
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Estado
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($ligas as $liga) : ?>
                                    <tr>
                                        <td logo class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 w-10 h-10">
                                                    <?php if (isset($liga['logo'])) : ?>
                                                        <img src="<?= $liga['logo'] ?>" alt="Logo de la liga">
                                                    <?php else : ?>
                                                        <img class="w-full h-full rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2.2&w=160&h=160&q=80" alt="" />
                                                    <?php endif; ?>
                                                </div>
                                                <div class="ml-3">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    <a href="/liga/show?id=<?php echo $liga['id']; ?>" class="text-blue-500 hover:underline"><?php echo $liga['nombre']; ?></a>
                                                </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td nombre_liga class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <?php foreach ($deportes as $deporte) {
                                                if ($deporte['id'] === $liga['deporte_id']) {
                                                    echo $deporte['nombre'];break;
                                                }
                                            }?>
                                        </td>
                                        <td fecha_inicio class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap"><?=date('d-m-Y', strtotime($liga['fecha_inicio']))?></p>
                                        </td>
                                        <td estado class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <?php foreach ($ligas as $liga) {
                                                switch ($liga['estado']) {
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
                                                }
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