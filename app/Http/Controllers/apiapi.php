<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tsaldo;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Contracts\DataTable;
use App\tlaporan;
use Yajra\DataTables\DataTables;
use App\tpoin;

class apiapi extends Controller
{
    //
    public function getSaldo()
    {
        $a = tsaldo::where('idUser', Session::get('userLogin')->id)->first();

        if ($a == null) {
            return 'x';
        } else {
            return response()->json($a);
        }
    }

    public function postSaldo(Request $a)
    {
        tsaldo::create([
            'jumlah' => $a->saldo,
            'idUser' => Session::get('userLogin')->id
        ]);

        return 'y';
    }

    /*
    |
    | LAPORAN
    |
    */

    public function getDataLaporan()
    {
        return DataTables::of(tlaporan::where('idUser', Session::get('userLogin')->id)->get())->make(true);
    }

    public function deleteDataLaporan(Request $a)
    {
        tlaporan::destroy($a->id);
    }

    public function addDataLaporan(Request $a)
    {
        $cek = tlaporan::where('tanggal', $a->tanggal)->get();

        if (count($cek) == 0) {

            tlaporan::create([
                'tanggal' => $a->tanggal,
                'idUser' => Session::get('userLogin')->id
            ]);

            return 'y';
        } else {
            return 'x';
        }
    }

    public function prepareEditLaporan(tlaporan $a)
    {
        return $a;
    }

    public function editDataLaporan(Request $a)
    {
        $cek = tlaporan::where('tanggal', $a->tanggal)->count();

        if ($cek > 0) {
            return 'x';
        } else {
            tlaporan::where([
                'id' => $a->id,
                'idUser' => Session::get('userLogin')->id
            ])->update([
                'tanggal' => $a->tanggal
            ]);

            return 'y';
        }
    }

    public function loadDataLaporan()
    {
        return tlaporan::where('idUser', Session::get('userLogin')->id)->get();
    }

    /*
    \
    \ PEMASPENGE
    \
    */

    public function loadDetailLaporan($id)
    {
        return tpoin::where([
            'idLaporan' => $id,
            'idUser' => Session::get('userLogin')->id
        ])->get();
    }

    public function poinLaporan(Request $a)
    {
        return tpoin::where([
            'idUser' => Session::get('userLogin')->id,
            'idLaporan' => $a->id
        ])->select('id', 'jenis', 'nama', 'banyak', 'harga', 'jumlah')->get();
    }

    public function deletePoinLaporan(Request $a)
    {
        tpoin::destroy($a->id);

        return tpoin::where([
            'idUser' => Session::get('userLogin')->id,
            'idLaporan' => $a->idLaporan
        ])->select('id', 'jenis', 'nama', 'banyak', 'harga', 'jumlah')->get();
    }
}
