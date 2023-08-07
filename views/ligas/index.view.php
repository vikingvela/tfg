<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>
<?="ligas/index.view.php"?>

<main>
    <div class="m-5 px-8 py-6 bg-white rounded grid">
        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
            <p>Resumen de las ligas</p>            
        </div>
        <?php if ($_SESSION['usuario'] ?? false) : ?> 
            <!-- Solo para usuarios que administran ligas-->            
            <?php if (!empty($ligasAdmin)) { ?>
                <h2>Ligas administradas por el usuario</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Deporte</th>
                            <th>Fecha de Inicio</th>
                            <th>Fecha de Fin</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($ligasAdmin as $liga) : ?>
                        <tr>
                        <td><a href="/liga/edit?id=<?php echo $liga['id']; ?>" class="text-blue-500 hover:underline"><?php echo $liga['nombre']; ?></a></td>
                            <td>
                                <?php 
                                foreach ($deportes as $deporte) {
                                    if ($deporte['id'] === $liga['deporte_id']) {
                                        echo $deporte['nombre'];
                                        break;
                                    }
                                }
                                ?>
                            </td>
                            <td><?php echo $liga['fecha_inicio']; ?></td>
                            <td><?php echo $liga['fecha_fin']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <!-- Botones -->
                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <a href="/ligas/create" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Nueva</a>
                </div>
            <?php }  ?>
        <?php endif ?>
        <!-- Listado de ligas total -->            
        <h2>Ligas</h2>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Deporte</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($ligas as $liga) : ?>
                <tr>
                    <td><a href="/liga/show?id=<?php echo $liga['id']; ?>" class="text-blue-500 hover:underline"><?php echo $liga['nombre']; ?></a></td>
                    <td>
                        <?php 
                        foreach ($deportes as $deporte) {
                            if ($deporte['id'] === $liga['deporte_id']) {
                                echo $deporte['nombre'];
                                break;
                            }
                        }
                        ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>

<?php require base_path('views/partials/footer.php') ?>
