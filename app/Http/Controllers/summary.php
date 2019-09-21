<?php

namespace App\Http\Controllers;

use App\tlaporan;
use App\tpoin;
use App\tsaldo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class summary extends Controller
{
    //

    public function summary()
    {
        $saldo = tsaldo::where('idUser', Session::get('userLogin')->id)->orderBy('created_at', 'asc')->limit(10)->get();
        $saldoSaldo = array();
        $tanggal = array();

        foreach ($saldo as $s) {
            array_push($saldoSaldo, $s->jumlah);
            array_push($tanggal, $s->created_at);
        }

        return response()->json([$saldoSaldo, $tanggal]);
    }

    public function pemasukanPengeluaran()
    {
        $res = array();

        $laporan = tlaporan::where('idUser', Session::get('userLogin')->id)->orderBy('tanggal', 'asc')->limit(10)->get();


        $index = 0;

        // dd($laporan);

        foreach ($laporan as $l) {
            $masuk = 0;
            $keluar = 0;

            $poinMasuk = tpoin::where([
                // 'idUser' => Session::get('userLogin')->id,
                'idLaporan' => $l->id,
                'jenis' => '+'
            ])->get();

            $poinKeluar = tpoin::where([
                'idUser' => Session::get('userLogin')->id,
                'idLaporan' => $l->id,
                'jenis' => '-'
            ])->get();

            foreach ($poinMasuk as $pM) {
                $masuk = $masuk + $pM->jumlah;
            }
            foreach ($poinKeluar as $pK) {
                $keluar = $keluar + $pK->jumlah;
            }
            array_push(
                $res,
                array(
                    'tanggal' => $l->tanggal,
                    'data' => array(
                        'masuk' => $masuk,
                        'keluar' => $keluar
                    )
                )
            );

            $index++;
        }

        return $res;
    }
}
