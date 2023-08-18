<?php require('partials/head.php') ?>
<?php require('partials/nav.php') ?>
<?php require('partials/banner.php') ?>

<main>
    <div class="m-5 px-8 py-6 bg-white rounded grid">
        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
            <p>Hola, <?= $_SESSION['usuario']['email'] ?? 'invitado' ?>. Bienvenido a la página de inicio.</p>            
        </div>
        <?php if ($_SESSION['usuario'] ?? false) : ?> 
            <!-- Solo para usuarios -->
            SOLO PARA USUARIOS LOGEADOS
        <?php endif ?>
    </div>
</main>

<?php require('partials/footer.php') ?>