<?php

use Animal\Middlewares\Auth;
use Animal\Middlewares\Guest;
use Animal\Middlewares\Csrf;
use Animal\Middlewares\RequestRequiresID;

return [
    [
        'uri' => '/', 'verb' => 'GET',
        'action' => [Animal\Controllers\PageController::class, 'welcome'],
    ],

    [
        'uri' => '/loss-declaration/create', 'verb' => 'GET',
        'action' => [Animal\Controllers\LossDeclarationController::class, 'create'],
    ],

    [
        'uri' => '/loss-declaration', 'verb' => 'POST',
        'action' => [Animal\Controllers\LossDeclarationController::class, 'store'],
        'middlewares' => [Csrf::class],
    ],

    [
        'uri' => '/loss-declaration/show', 'verb' => 'GET',
        'action' => [Animal\Controllers\LossDeclarationController::class, 'show'],
        'middlewares' => [Auth::class, RequestRequiresID::class],
    ],

    [
        'uri' => '/loss-declaration/edit', 'verb' => 'GET',
        'action' => [Animal\Controllers\LossDeclarationController::class, 'edit'],
        'middlewares' => [Auth::class,  RequestRequiresId::class],
    ],

    [
        'uri' => '/loss-declaration/edit', 'verb' => 'POST',
        'action' => [Animal\Controllers\LossDeclarationController::class, 'update'],
        'middlewares' => [Auth::class, RequestRequiresId::class],
    ],

    [
        'uri' => '/loss/edit',
        'verb' => 'GET',
        'action' => [Animal\Controllers\LossController::class, 'edit'],
        'middlewares' => [Auth::class, RequestRequiresID::class],
    ],
    [
        'uri' => '/pet/edit',
        'verb' => 'GET',
        'action' => [Animal\Controllers\PetController::class, 'edit'],
        'middlewares' => [Auth::class, RequestRequiresID::class],
    ],

    [
        'uri' => '/pet/edit',
        'verb' => 'POST',
        'action' => [Animal\Controllers\PetController::class, 'update'],
        'middlewares' => [Auth::class, RequestRequiresID::class],
    ],

    [
        'uri' => '/pet-owner/edit',
        'verb' => 'GET',
        'action' => [Animal\Controllers\PetOwnerController::class, 'edit'],
        'middlewares' => [Auth::class, RequestRequiresID::class],
    ],

    [
        'uri' => '/pet-owner/edit',
        'verb' => 'POST',
        'action' => [Animal\Controllers\PetOwnerController::class, 'update'],
        'middlewares' => [Auth::class, RequestRequiresID::class],
    ],

    [
        'uri' => '/login',
        'verb' => 'GET',
        'action' => [Animal\Controllers\AuthenticatedSessionController::class, 'create'],
        'middlewares' => [Guest::class],
    ],

    [
        'uri' => '/login',
        'verb' => 'POST',
        'action' => [Animal\Controllers\AuthenticatedSessionController::class, 'store'],
        'middlewares' => [Guest::class, Csrf::class],
    ],

    [
        'uri' => '/logout',
        'verb' => 'POST',
        'action' => [Animal\Controllers\AuthenticatedSessionController::class, 'destroy'],
        'middlewares' => [Auth::class, Csrf::class],
    ],
    [
        'uri' => '/register',
        'verb' => 'GET',
        'action' => [Animal\Controllers\RegisterSessionController::class, 'create'],
        'middlewares' => [Guest::class],
    ],

    [
        'uri' => '/register',
        'verb' => 'POST',
        'action' => [Animal\Controllers\RegisterSessionController::class, 'store'],
        'middlewares' => [Guest::class, Csrf::class],
    ],

    [
        'uri' => '/dashboard',
        'verb' => 'GET',
        'action' => [Animal\Controllers\DashboardController::class, 'index'],
        'middlewares' => [Auth::class],
    ],

    [
        'uri' => '/profile/edit',
        'verb' => 'GET',
        'action' => [Animal\Controllers\ProfileController::class, 'edit'],
        'middlewares' => [Auth::class],
    ],

    [
        'uri' => '/profile/edit',
        'verb' => 'POST',
        'action' => [Animal\Controllers\ProfileController::class, 'update'],
        'middlewares' => [Auth::class, RequestRequiresID::class],
    ],
    [
        'uri' => '/lang',
        'verb' => 'POST',
        'action' => [Animal\Controllers\LanguageController::class, 'update'],
        'middlewares' => [Auth::class, Csrf::class],
    ],
    [
        'uri' => '/pet-type/create',
        'verb' => 'GET',
        'action' => [Animal\Controllers\PetType::class, 'create'],
        'middlewares' => [Auth::class],
    ],
    [
        'uri' => '/pet-type',
        'verb' => 'POST',
        'action' => [Animal\Controllers\PetType::class, 'store'],
        'middlewares' => [Auth::class, Csrf::class],
    ],
];