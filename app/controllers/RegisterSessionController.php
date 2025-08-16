<?php

namespace Animal\Controllers;

use Animal\Models\User;
use Tecgdcs\Response;
use Tecgdcs\Validator;
use Tecgdcs\View;

class RegisterSessionController
{
    public function create()
    {
        $title = 'Créer un compte';
        View::make('auth.register', compact('title'));
    }

    public function store()
    {
        $data = Validator::check([
            'email' => 'required|email',
            'email_same' => 'required|same:email',
            'language' => 'required|lang',
            'password' => 'required'
        ]);

        // Email
        $existing_email = User::where('email', $data['email'])->first();
        if ($existing_email) {
            $_SESSION['errors']['email'] = 'Cette adresse mail est déjà prise, veuillez en choisir une autre !';
            Response::redirect($_SERVER['HTTP_REFERER']);
        }

        // Password
        $password = password_hash($data['password'], PASSWORD_BCRYPT);


        // Créer un nouvel utilisateur dans la DB
        User::create([
            'email' => $data['email'],
            'password' => $password,
            'preferences' => json_encode(['language' => $data['language']]),
        ]);

        $_SESSION = [];
        $_SESSION['user'] = User::where('email', $data['email'])->first();
        Response::redirect('/dashboard');
    }
}