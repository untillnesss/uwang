<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class tpoin extends Model
{
    //
    use SoftDeletes;
    protected $fillable = ['jenis', 'nama', 'banyak', 'harga', 'jumlah', 'idLaporan', 'idUser'];
}
