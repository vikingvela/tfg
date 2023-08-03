<?php

namespace Core\Middleware;

class Admin
{
    public function handle()
    {
      if (!isAdmin($_SESSION['usuario'])) {
            header('location: /');
            exit();
        }
    }
}