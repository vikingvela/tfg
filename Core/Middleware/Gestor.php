<?php

namespace Core\Middleware;

class Gestor
{
    public function handle()
    {
      if (!isGestor($_SESSION['usuario'])) {
            header('location: /');
            exit();
        }
    }
}