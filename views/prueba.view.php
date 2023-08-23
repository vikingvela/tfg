<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>
<?="prueba.view.php"?>

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
<script>
    function filterLigas() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("ligaTableBody");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>

<main>
    <body class="antialiased font-sans bg-gray-200">
        <div class="m-5 px-8 py-6 bg-white rounded grid">
            <div class="container mx-auto px-4 rounded sm:px-8">
                <div class="py-8">
                    <h2 class="mx-auto text-3xl font-semibold leading-tight">Ligas</h2>
                    <div class="my-2 flex sm:flex-row flex-col items-center justify-between">
                        <!-- Filtro de número de elementos por página y estado -->
                        <div class="flex flex-row mb-1 sm:mb-0">
                            <div class="relative">
                                <select class="appearance-none h-full rounded-l border block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                    <option>5</option>
                                    <option>10</option>
                                    <option>20</option>
                                </select>
                            </div>
                            <div class="relative">
                                <form id="filtroForm" method="get">
                                    <select name="estado" onchange="document.getElementById('filtroForm').submit()" class="appearance-none h-full rounded-r border-t sm:rounded-r-none sm:border-r-0 border-r border-b block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:border-l focus:border-r focus:bg-white focus:border-gray-500">
                                        <option value="" <?php if ($estadoFiltro >= '0') echo 'selected'; ?>>Todas</option>
                                        <option value="1" <?php if ($estadoFiltro === '1') echo 'selected'; ?>>1</option>
                                        <option value="0" <?php if ($estadoFiltro === '0') echo 'selected'; ?>>0</option>
                                        <option value="2" <?php if ($estadoFiltro === '2') echo 'selected'; ?>>2</option>
                                    </select>
                                </form>
                            </div>
                        </div>
                        <!-- Cuadro de búsqueda -->
                        <div buscador class="block relative">
                            <span class="h-full absolute inset-y-0 left-0 flex items-center pl-2"><svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500"><path d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z"></path></svg></span>
                            <input type="text" id="searchInput" onkeyup="filterLigas()" placeholder="Buscar liga" class="appearance-none rounded-r rounded-l sm:rounded-l-none border border-gray-400 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none" />
                        </div>
                    </div>
                    <div class="mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                        <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                            <table class="tabla min-w-full leading-normal">
                                <thead>
                                    <tr>
                                        <th>Liga</th>
                                        <th>Deporte</th>
                                        <th>Fecha inicio</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody id="ligaTableBody">
                                    <!-- Renderizar filas de la tabla aquí -->
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
</main>



<?php require base_path('views/partials/footer.php') ?>