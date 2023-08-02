<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>
<!-- dd($_SESSION['usuario']['email']) -->
<main>
    <div class="m-5 px-8 py-6 bg-white rounded grid">
        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
            <p>Resumen de las ligas</p>            
        </div>
        <?php if ($_SESSION['usuario'] ?? false) : ?> 
            <!-- Solo para usuarios -->
            
            <h2>Ligas administradas por el usuario</h2>
            <?php if (isset($ligasAdmin) && !empty($ligasAdmin)) { ?>    
                <table>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Deporte</th>
                            <th>Fecha de Inicio</th>
                            <th>Fecha de Fin</th>
                            <th>Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($ligasAdmin as $liga) : ?>
                        <tr>
                            <td><?php echo $liga['nombre']; ?></td>
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
                            <td><a href="/liga/edit?id=<?php echo $liga['id']; ?>" class="text-blue-500 hover:underline">Editar</a></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <div>
                    asdasd
                </div>
            <?php } ?>
        <p class="mt-6">
            <a href="/ligas/create" class="text-blue-500 hover:underline">Crear liga</a>
        </p>
        <?php endif ?>
    </div>
</main>

<?php require base_path('views/partials/footer.php') ?>
