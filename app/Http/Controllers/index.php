<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class index extends Controller
{
    public function index()
    {
        include 'role.php';
        return role('page.dashboard', 'login', [
            'ses' => Session::get('userLogin')
        ]);
    }
}
