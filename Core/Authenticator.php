<?php

namespace Core;

class Authenticator
{
    public function attempt($email, $password)
    {
        $user = App::resolve(Database::class)
            ->query('select * from USUARIO where email = :email', [
            'email' => $email
        ])->find();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $this->login([
                    'email' => $email
                ]);

                return true;
            }
        }
        return false;
    }

    public function login($user)
    {
        $db = App::resolve(Database::class);

        $_SESSION['usuario'] = ['email' => $user['email']];

        $db->update('USUARIO', [
            'email' => $user['email'],
            'ultima_sesion' => date('Y-m-d H:i:s')
        ]);

        session_regenerate_id(true);
    }
    public function loginID($user)
    {        
        $_SESSION['usuario'] = ['id' => $user['id']];

        session_regenerate_id(true);
    }

    public function logout()
    {
        Session::destroy();
    }
}