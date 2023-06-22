<?php require('partials/head.php') ?>
<?php require('partials/nav.php') ?>
<?php require('partials/banner.php') ?>

<?php dd($_POST); ?>

<!--
use Core\App;
use Core\Validator;
use Core\Database;

$db = App::resolve(Database::class);



$nombre = $_POST['nombre'];
if (isset($_POST['logo']) ? $logo = $_POST['logo'] : $logo = null);
if (isset($_POST['cover']) ? $cover = $_POST['cover'] : $cover = null);
$creado_por = getUsuarioIDbyEmail($_POST['usuario']);
echo 'sesion';
//dd($creado_por);
echo 'sesion';

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <p>Página de prueba.</p>
    </div>
</main>

<?php require('partials/footer.php') ?>
