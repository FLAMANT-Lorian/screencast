<?php

namespace Animal\Controllers;

use Animal\Models\User;
use Illuminate\Support\Facades\Redirect;
use Tecgdcs\Response;
use Tecgdcs\Validator;
use Tecgdcs\View;

class AuthenticatedSessionController
{
    public function create()
    {
        View::make('auth.login');
    }

    public function destroy()
    {
        $_SESSION = [];
        session_destroy();
        Response::redirect('/');
    }

    public function store()
    {
        $data = Validator::check([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Vérifier dans la BD

        $user = User::where('email', $_REQUEST['email'])->first();
        if (!$user) {
            $_SESSION['errors']['email'] = 'Cet email n’existe pas dans la DB';
            $_SESSION['old']['email'] = $_REQUEST['email'];
            Response::back();
        }

        if (!password_verify($_REQUEST['password'], $user->password)) {
            $_SESSION['old']['email'] = $_REQUEST['email'];
            $_SESSION['errors']['password'] = 'Ce mot de passe ce correspond pas à cette adresse email';
            Response::back();
        }

        $_SESSION = [];
        $_SESSION['user'] = $user;
        Response::redirect('/dashboard');
    }
}