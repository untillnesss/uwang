<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class tlaporan extends Model
{
    //
    // use SoftDeletes;
    protected $fillable = ['tanggal', 'idUser'];
}
