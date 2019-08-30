<?php

function role($view, $type, $passing = [])
{

    if ($type == 'login') {
        if (!Session::has('userLogin')) {
            return redirect()->route('masuk');
        } else {
            return view($view, $passing);
        }
    } else if ($type == 'guest') {
        if (Session::has('userLogin')) {
            return redirect()->route('dashboard');
        } else {
            return view($view, $passing);
        }
    }
}
