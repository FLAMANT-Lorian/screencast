<?php

namespace Animal\Controllers;

use Animal\Models\User;
use Tecgdcs\Response;
use Tecgdcs\Validator;
use Tecgdcs\View;

class ProfileController
{
    public function edit()
    {
        $id = (int)trim($_SESSION['user']->id);

        $title = 'Vos données personnelles';
        $user = User::findOrFail($id);
        View::make('profile.edit', compact('title', 'user'));
    }

    public function update()
    {
        $id = (int)trim($_SESSION['user']->id);

        $data = Validator::check([
            'password' => 'required',
            'password_old' => 'required'
        ]);

        $user = User::findOrFail($id);
        $old_password = $user->password;

        if (!password_verify($data['password_old'], $old_password)) {
            $_SESSION['errors']['password_old'] = 'Mot de passe incorrect';
            Response::back();
        }

        $user->password = password_hash($data['password'], PASSWORD_BCRYPT);
        $user->save();

        Response::redirect('/profile/edit');
    }
}
