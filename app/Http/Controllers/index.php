<?php

namespace App\Http\Controllers;

use App\tanggota;
use App\tlaporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class index extends Controller
{
    public function index()
    {
        include 'role.php';


        if (Session::has('userLogin')) {
            $jumlahLaporan = tlaporan::where('idUser', Session::get('userLogin')->id)->count();
            $jumlahOrang = tanggota::where([
                'idUser' => Session::get('userLogin')->id,
                'status' => 'acc'
            ])->count();

            return role('page.dashboard', 'login', [
                'ses' => Session::get('userLogin'),
                'jumlahLaporan' => $jumlahLaporan,
                'jumlahOrang' => $jumlahOrang,
            ]);
        } else {
            return role('page.dashboard', 'login', [
                'ses' => Session::get('userLogin'),
            ]);
        }
    }
}
