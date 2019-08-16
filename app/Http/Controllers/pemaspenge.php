<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class pemaspenge extends Controller
{
    public function index()
    {
        include 'role.php';
        return role('page.pemaspenge', 'login');
    }
}
