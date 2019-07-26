<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\tuser;

class daftar extends Controller
{
    //
    public function index()
    {
        return view('daftar');
    }

    public function daftar(Request $a)
    {
        tuser::create([
            'nama'=>$a->nama,
            'email'=>$a->email,
            'password' => $a->pass,
            'org'=>$a->org
        ]);

        return 'y';
    }
}
