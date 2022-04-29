<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Telescope\Http\Controllers\HomeController;

class TelescopeCommandsController extends HomeControllers
{
    /**
     * @return mixed
     */
    public function index()
    {
        return parent::index();
    }
}
