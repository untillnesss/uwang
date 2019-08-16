<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class laporan extends Controller
{
    public function index()
    {
        include 'role.php';
        return role('page.laporan', 'login');
    }
}
