<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tuser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\tanggota;

class masuk extends Controller
{
    public function index()
    {
        include 'role.php';
        return role('page.masuk', 'guest');
    }

    public function putSess($data, $tip)
    {

        $a = $data[0];
        if ($tip == 'admin') {
            $session = collect(
                [
                    (object) [
                        'id' => $a->id,
                        'nama' => $a->nama,
                        'org' => $a->org,
                        'idLevel' => $a->idLevel
                    ]
                ]
            );
        } else {
            $session = collect(
                [
                    (object) [
                        'id' => $a->idUser,
                        'nama' => $a->nama,
                        'org' => $a->tusers->org,
                        'idLevel' => $a->idLevel
                    ]
                ]
            );
        }
        Session::put('userLogin', $session[0]);
    }

    public function masuk(Request $a)
    {
        $user = tuser::where('email', $a->email)->get();

        if (count($user) == 0) {
            $userr = tanggota::where('email', $a->email)->get();

            if (count($userr) == 0) {
                return 'x';
            } else {
                if (Hash::check($a->pass, $userr[0]->password)) {
                    masuk::putSess($userr, 'anggota');
                    return 'y';
                } else {
                    return 'x';
                }
            }
        } else {
            if (Hash::check($a->pass, $user[0]->password)) {
                masuk::putSess($user, 'admin');
                return 'y';
            } else {
                return 'x';
            }
        }
    }

    public function cekEmail(Request $a)
    {
        $cek = tanggota::where([
            'email' => $a->email,
            'status' => 'pending'
        ])->count();

        if ($cek > 0) {
            return 'y';
        } else {
            return 'x';
        }
    }

    public function cekKode(Request $a)
    {
        $cek = tanggota::where([
            'email' => $a->email,
            'kode' => $a->kode
        ])->count();

        if ($cek > 0) {
            return 'y';
        } else {
            return 'x';
        }
    }

    public function storePass(Request $a)
    {
        $cek = tanggota::where([
            'email' => $a->email,
            'kode' => $a->kode
        ]);

        if ($cek->count() > 0) {
            $cek->update([
                'password' => Hash::make($a->pass),
                'status' => 'acc'
            ]);

            return 'y';
        } else {
            return 'x';
        }
    }

    public function klaim()
    {
        Session::flash('klaim');
        include 'role.php';
        return role('page.masuk', 'guest');
    }

    public function tolak(Request $a)
    {
        $data = tanggota::where('email', $a->email);
        $data->update([
            'status' => 'not'
        ]);
        $data->delete();



        return 'y';
    }
}
