<?php

namespace App\Controllers\Front;

use App\Controllers\BaseController;

class AboutController extends BaseController {
    
    public function index() {
        return view('Front\about');
    }
}
