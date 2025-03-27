<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Laramin\Utility\Onumoti;
use Illuminate\Support\Facades\Session;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $activeTemplate;

    public function __construct()
    {

//        $default = session()->get('default_template');
        $default = Session::get('default_template');
        if($default != null || $default != '')
        {
            $template = $default;
        }
        $this->activeTemplate = activeTemplate();

        $className = get_called_class();
        Onumoti::mySite($this,$className);
    }
}
