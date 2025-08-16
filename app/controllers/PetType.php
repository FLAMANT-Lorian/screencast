<?php

namespace Animal\Controllers;

use Tecgdcs\Response;
use Tecgdcs\Validator;
use Tecgdcs\View;

class PetType
{
    public function create()
    {
        $title = 'Déclarer un nouveau type d\'animal';
        View::make('pet-type.create', compact('title'));
    }

    public function store()
    {
        $data = Validator::check([
            'pet-type' => 'required'
        ]);

        $existing_breed = \Animal\Models\PetType::where('code', $data['pet-type'])->first();
        if (!$existing_breed) {
            \Animal\Models\PetType::create([
                'code' => $data['pet-type'],
            ]);
        }

        Response::redirect($_SERVER['HTTP_REFERER']);
    }

}