<?php

namespace Animal\Controllers;

use Tecgdcs\Response;
use Tecgdcs\View;


class PageController
{
    public function welcome()
    {
        View::make('home.welcome');
    }
}
