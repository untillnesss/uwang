<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\tuser;
use Illuminate\Support\Facades\Hash;

class daftar extends Controller
{
    //
    public function index()
    {
        include 'role.php';
        return role('page.daftar', 'guest');
    }

    public function daftar(Request $a)
    {
        $cek = tuser::where('email', $a->email)->get()->count();

        if ($cek == 0) {

            tuser::create([
                'nama' => $a->nama,
                'email' => $a->email,
                'password' => Hash::make($a->pass),
                'org' => $a->org
            ]);

            return 'y';
        } else {
            return 'x';
        }
    }
}
