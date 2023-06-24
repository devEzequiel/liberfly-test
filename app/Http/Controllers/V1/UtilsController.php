<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;

class UtilsController extends Controller
{
    public function healthCheck()
    {
        echo 'It\'s working';
    }
}
