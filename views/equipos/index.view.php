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
                        <th>Liga</th>
                        <th>Deporte</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($equipos as $equipo) : ?>
                    <tr>
                        <td><a href="/equipo/show?id=<?php echo $equipo['id']; ?>" class="text-blue-500 hover:underline"><?php echo $equipo['nombre']; ?></a></td>
                        <td><a href="/equipo/show?id=<?php echo $equipo['liga_id']; ?>" class="text-blue-500 hover:underline"><?php echo(getNombrebyID($equipo['liga_id'], 'LIGA')) ?></a></td>
                        <td><?php echo $equipo['deporte_id']; ?></td>
                        <?php if ($usuarioID ?? false) : 
                            if ($usuarioID == $equipo['creado_por'] || isAdmin($usuarioID)) ?>
                            <td><a href="/equipo/edit?id=<?php echo $equipo['id']; ?>" class="text-blue-500 hover:underline">Editar</a></td>
                        <?php endif ?> 
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <!-- Botones exclusivos si el usuario se encuentra logeado -->
        <?php if ($_SESSION['usuario'] ?? false) : ?>
        <p class="mt-6"><a href="/equipos/create" class="text-blue-500 hover:underline">Crear equipo</a></p>
        <?php endif ?>
    </div>
</main>

<?php require base_path('views/partials/footer.php') ?>
