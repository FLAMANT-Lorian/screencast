<?php

namespace Animal\Controllers;

use Animal\Models\User;
use Tecgdcs\Response;
use Tecgdcs\Validator;

class LanguageController
{
    public function update()
    {
        $data = Validator::check([
            'language' => 'required|lang',
        ]);

        $preferences = json_decode($_SESSION['user']->preferences, true);
        $preferences['language'] = $data['language'];
        $_SESSION['user']->preferences = json_encode($preferences);

        $user = User::where('id',$_SESSION['user']->id)->first();
        $user->preferences = $_SESSION['user']->preferences;
        $user->save();

        Response::redirect($_SERVER['HTTP_REFERER']);
    }
}
