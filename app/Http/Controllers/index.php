<?php

namespace App\Http\Controllers;

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
            return role('page.dashboard', 'login', [
                'ses' => Session::get('userLogin'),
                'jumlahLaporan' => $jumlahLaporan
            ]);
        } else {
            return role('page.dashboard', 'login', [
                'ses' => Session::get('userLogin'),
            ]);
        }
    }
}
