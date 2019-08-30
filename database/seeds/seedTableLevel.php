<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class seedTableLevel extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lvl = ['admin', 'bendahara', 'anggota'];

        foreach ($lvl as $l) {
            DB::table('tlevels')->insert([
                'nama' => $l
            ]);
        }
    }
}
