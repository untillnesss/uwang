<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class tanggota extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function tusers()
    {
        return $this->belongsTo(tuser::class, 'idUser', 'id');
    }
}
