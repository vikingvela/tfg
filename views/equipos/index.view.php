<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>
<?="equipos/index.view.php"?>

<main>
    <div class="m-5 px-8 py-6 bg-white rounded grid">
        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
            <p>Listado de equipos</p>            
        </div>            
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Estado</th>
                        <th>Editar</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($equipos as $equipo) : ?>
                    <tr>
                        <td><?php echo $equipo['nombre']; ?></td>
                        <td><?php echo $equipo['estado']; ?></td>
                        <td><a href="/equipo/edit?id=<?php echo $equipo['id']; ?>" class="text-blue-500 hover:underline">Editar</a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <p class="mt-6">
            <a href="/equipos/create" class="text-blue-500 hover:underline">Crear equipo</a>
        </p>
    </div>
</main>

<?php require base_path('views/partials/footer.php') ?>
