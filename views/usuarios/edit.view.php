<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>
<?php $perfil = getProfilebyID($usuario);?>

<main>
<div class="m-5 px-8 py-6 bg-white rounded grid">
  <form action="/usuario" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="_method" value="PATCH">
      <input type="hidden" name="id" value="<?= $perfil['id'] ?>">
    <div class="space-y-12">
      <div class="border-b border-gray-900/10 pb-12">
        <h2 class="text-base font-semibold leading-7 text-gray-900">Perfil de usuario</h2>
        <div class="mt-4 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-4">
          <div class="col-span-1 ">
            <div class="mt-5 flex items-center gap-x-3">
              <svg class="h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" clip-rule="evenodd" />
              </svg>
              <button type="button" class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Foto</button>
            </div>
          </div>
          <div class="col-span-1">
            <label for="nombre" class="block text-sm font-medium leading-6 text-gray-900"></label>
            <div class="mt-2">
              <input type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                name="nombre"
                id="nombre"
                placeholder="Nombre"
                required
                value="<?=isset($perfil['nombre']) ? $perfil['nombre'] : "" ?>">
            </div>
            <?php if (isset($errors['apellido'])) : ?><p class="text-red-500 text-xs mt-2"><?= $errors['apellido'] ?></p><?php endif; ?>
          </div>
          <div class="col-span-1">
            <label for="apellido" class="block t->only('auth')ext-sm font-medium leading-6 text-gray-900"></label>
            <div class="mt-2">
              <input type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                name="apellido"
                id="apellido"
                placeholder="Apellido"
                required
                value="<?=isset($perfil['apellido']) ? $perfil['apellido'] : "" ?>">
              </div>
              <?php if (isset($errors['apellido'])) : ?><p class="text-red-500 text-xs mt-2"><?= $errors['apellido'] ?></p><?php endif; ?>
          </div>
          <div class="col-span-1">
            <div class="flex items-center">
              <div class="mt-2">
                <label for="email" class="block text-sm font-medium leading-6 text-gray-900"></label>
                <input class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-900 sm:text-sm sm:leading-6"
                  id="email"
                  name="email"
                  type="email"
                  readonly
                  value="<?=$perfil['email']?>">
              </div>
              <div class="mt-2 ml-2">
                <button type="button" onclick="window.location.href='/prueba'" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Cambiar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="mt-6 flex items-center justify-end gap-x-6">
      <button type="button" onclick="javascript:history.back()" class="text-sm font-semibold leading-6 text-gray-900">Cancelar</button>
      <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Guardar</button>
    </div>
  </form>      
</div>
</main>

<?php require base_path('views/partials/footer.php') ?>
