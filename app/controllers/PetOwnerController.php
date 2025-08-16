<?php

namespace Animal\controllers;

use Animal\Models\Loss;
use Animal\Models\PetOwner;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Tecgdcs\Response;
use Tecgdcs\Validator;
use Tecgdcs\View;

class PetOwnerController
{
    public function edit()
    {

        // Si vous êtes très très inquiet, mais le code avant fait les vérifications nécessaires
        $id = (int)trim($_REQUEST['id']);

        try {
            $pet_owner = PetOwner::findOrFail($id);
            $losses = Loss::where('pet_owner_id', $id)->get();
        } catch (ModelNotFoundException $e) {
            Response::abort();
        }
        $title = 'Mettre à jour les informations de ' . $pet_owner->name;

        // Analyser la query string pour savoir quelle déclaration afficher
        View::make("pet-owner.edit", compact('title', 'pet_owner', 'losses'));
    }

    public function update()
    {
        $id = (int)trim($_REQUEST['id']);

        Validator::check([
            'first_name' => 'required',
            'last_name' => 'required'
        ]);

        $pet_owner = PetOwner::findOrFail($id);
        $pet_owner->first_name = trim($_REQUEST['first_name']);
        $pet_owner->last_name = trim($_REQUEST['last_name']);
        $pet_owner->save();

        Response::redirect('/dashboard');
    }
}
