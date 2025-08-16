<?php

namespace Tecgdcs;

use eftec\bladeone\BladeOne;

class View extends BladeOne
{
    use \Tecgdcs\concerns\View;

    const string VIEW_DIR = __DIR__ . '/../resources/views';
    const string CACHE_DIR = __DIR__ . '/../storage/cache';


    public static function make(string $view, array $data = [])
    {
        // New BladeOne fait la même chose
        $instance = new self(self::VIEW_DIR, self::CACHE_DIR, self::MODE_DEBUG);
        if (isset($_SESSION['user'])) {
            $instance->setAuth($_SESSION['user']->email);
        }
        echo $instance->run($view, $data);
    }
}