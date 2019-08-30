<?php

namespace App\Http\Controllers;

use App\tlevel;
use Illuminate\Http\Request;

class anggota extends Controller
{
    //
    public function index()
    {
        include 'role.php';
        $lvl = tlevel::all();
        return role('page.anggota', 'login', ['level' => $lvl]);
    }
}
