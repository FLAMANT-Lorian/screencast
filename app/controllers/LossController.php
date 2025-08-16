<?php

namespace Animal\Controllers;

use Tecgdcs\View;

class LossController
{
    public function edit()
    {
        View::make('edit.loss');
    }
}