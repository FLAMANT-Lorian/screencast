<?php

namespace Animal\Middlewares;

use Tecgdcs\Contracts\Middleware;
use Tecgdcs\Response;

class RequestRequiresID implements Middleware
{

    public function handle(): void
    {
        if (!isset($_REQUEST['id']) || !is_numeric($_REQUEST['id'])) {
            Response::abort(Response::BAD_REQUEST);
        }
    }
}