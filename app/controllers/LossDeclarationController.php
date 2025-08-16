<?php

namespace Animal\Controllers;

use Animal\Models\Country;
use Animal\Models\Loss;
use Animal\Models\PetOwner;
use Animal\Models\PetType;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use JetBrains\PhpStorm\NoReturn;
use Tecgdcs\Response;
use Tecgdcs\Validator;
use Tecgdcs\View;

class LossDeclarationController
{
    public function create()
    {
        $countries = Country::all();
        $pet_types = PetType::all();
        $title = 'J’ai perdu mon animal !';
        $tatoos = require LANG_DIR . '/fr/tattoos.php';

        View::make("lossdeclaration.create", compact('countries', 'pet_types', 'tatoos', 'title'));
    }

    #[NoReturn]
    public function store(): void
    {

        $_SESSION['errors'] = null;
        $_SESSION['old'] = null;

        Validator::check([
            'email' => 'required|email',
            'vemail' => 'required|same:email',
            'phone' => 'phone',
            'country' => 'exists:countries,code',
            'pet-type' => 'exists:pet_types',
            'pet-name' => 'required',
        ]);


        PetOwner::upsert([
            [
                'first_name' => $_REQUEST['first-name'],
                'last_name' => $_REQUEST['last-name'],
                'email' => $_REQUEST['email'],
                'phone' => $_REQUEST['phone'],
                'country_id' => Country::where('code', $_REQUEST ['country'])->first()->id
            ],
        ],
            uniqueBy: ['email'],
            update: ['phone']
        );

        $loss = Loss::latest('updated_at')->first();

        Response::redirect('/loss-declaration/show?id=' . $loss->id);
    }

    public function show()
    {

        // Si vous êtes très très inquiet, mais le code avant fait les vérifications nécessaires
        $id = (int)trim($_REQUEST['id']);

        try {
            $loss = Loss::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Response::abort();
        }

        $title = 'Détails de la déclaration de perte';

        // Analyser la query string pour savoir quelle déclaration afficher
        View::make("lossdeclaration.show", compact('title', 'loss'));
    }

    public function edit()
    {
        $id = (int)trim($_REQUEST['id']);

        $title = 'Modifier la déclaration';
        $loss = Loss::where('id', $id)->first();

        View::make('lossdeclaration.edit', compact('title', 'loss'));
    }

    public function update()
    {
        $id = (int)trim($_REQUEST['id']);
        $loss = Loss::where('id', $id)->first();

        if ($_REQUEST['archive']){
            $loss->archive = true;
        } else {
            $loss->archive = false;
        }
        $loss->save();

        Response::redirect('/dashboard');
    }
}

