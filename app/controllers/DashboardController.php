<?php

namespace Animal\Controllers;

use Animal\Models\Loss;
use Tecgdcs\Response;
use Tecgdcs\View;

class DashboardController
{
    public function index()
    {
        $title = 'Les déclarations de perte';
        $archive_losses = Loss::where('archive', true)->get();
        $not_archive_losses = Loss::where('archive', false)->get();

        View::make('dashboard.index', compact('title', 'archive_losses', 'not_archive_losses'));
    }
}