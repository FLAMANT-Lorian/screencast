<?php

/**
 * Un bac à sable pour tester le fonctionnement de certaines fonctions PHP
 */
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/core/helpers/functions.php';
define('DATABASE_PATH', __DIR__ . '/database.sqlite');
require __DIR__ . '/core/database/dbconnection.php';

use Animal\Models\Country;
use Animal\Models\Pet;

/*$belgium = Country::where('code', 'BE')->first();
echo $belgian_pet_owners = $belgium->pet_owners->count();
echo PHP_EOL;

$lorian = \Animal\Models\PetOwner::where('email', 'l@f.be')->first();
echo $lorian->country->code;
echo PHP_EOL;

$rocky = Pet::where('name', 'Rocky')->first();
echo $rocky->pet_type->code;
echo PHP_EOL;

echo $rocky->losses()->latest('lost_at')->first()->pet_owner->email;
echo PHP_EOL;

echo Pet::where('name', 'titi')->first()->tattoo['code'];
echo PHP_EOL;*/

$client = new GuzzleHttp\Client();
$response = $client->request('GET', 'https://restcountries.com/v3.1/all?fields=cca2');
$codes = json_decode($response->getBody()->getContents(), true);
$codes_simple = array_map(fn ($item) => $item['cca2'], $codes);
var_dump($codes_simple);die();


