<?php

namespace App\Http\Controllers;

use App\tanggota;
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
            $cekk = tanggota::where('email', $a->email)->get();

            if ($cekk->count() == 0) {

                tuser::create([
                    'nama' => $a->nama,
                    'email' => $a->email,
                    'password' => Hash::make($a->pass),
                    'org' => $a->org,
                    'idLevel' => 1
                ]);
                return 'admin';
            } else {
                if ($cekk[0]->status == 'acc' || $cekk[0]->status == 'not') {
                    return 'x';
                } else {
                    return 'uda';
                }
            }
        } else {
            return 'x';
        }
    }
}
