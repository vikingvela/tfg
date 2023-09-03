<?php

namespace Core;

class ValidationException extends \Exception
{
    public readonly array $errors;
    public readonly array $old;

    public static function throw($errors, $old)
    {
       $instance = new static('El formulario no ha podido validar');

       $instance->errors = $errors;
       $instance->old = $old;

       throw $instance;
    }
}