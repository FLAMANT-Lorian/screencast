<?php

namespace Animal\controllers;

use Animal\Models\Pet;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Redirect;
use Tecgdcs\Response;
use Tecgdcs\Validator;
use Tecgdcs\View;

class PetController
{
    public function edit()
    {
        // Si vous êtes très très inquiet, mais le code avant fait les vérifications nécessaires
        $id = (int)trim($_REQUEST['id']);

        try {
            $pet = Pet::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Response::abort();
        }
        $title = 'Mettre à jour la fiche de ' . $pet->name;

        // Analyser la query string pour savoir quelle déclaration afficher
        View::make("pet.edit", compact('title', 'pet'));
    }

    public function update()
    {
        $id = (int)trim($_REQUEST['id']);

        Validator::check([
            'name' => 'required'
        ]);

        $pet = Pet::findOrFail($id);
        $pet->name = trim($_REQUEST['name']);
        $pet->save();

        Response::redirect('/dashboard');
    }
}
