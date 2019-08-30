<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tuser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class masuk extends Controller
{
    public function index()
    {
        include 'role.php';
        return role('page.masuk', 'guest');
    }

    public function masuk(Request $a)
    {
        $user = tuser::where('email', $a->email)->get();

        if (count($user) == 0) {
            return 'x';
        } else {
            if (Hash::check($a->pass, $user[0]->password)) {
                Session::put('userLogin', $user[0]);                                    //PUT SESSIOON
                return 'y';
            } else {
                return 'x';
            }
        }
    }
}
