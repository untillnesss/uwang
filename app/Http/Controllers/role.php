<?php

function role($view, $type, $passing = [])
{

    if ($type == 'login') {
        if (!Session::has('userLogin')) {
            return redirect()->route('masuk');
        } else {
            $sesi = Session::get('userLogin');
            $route = Route::currentRouteName();
            $role = [
                /*'admin' => */
                [
                    'dashboard', 'laporan', 'pemaspenge', 'anggota', 'keluar'
                ],
                /*'bendahara' => */
                [
                    'dashboard', 'laporan', 'pemaspenge', 'keluar'
                ],
                /*'anggota' => */
                [
                    'dashboard', 'keluar'
                ]
            ];

            if ($sesi->idLevel == '1') {
                $role = $role[$sesi->idLevel - 1];

                foreach ($role as $r) {
                    if ($r == $route) {
                        return view($view, $passing);
                    } else {
                        continue;
                    }
                }
                return redirect()->route('dashboard');
            } else if ($sesi->idLevel == '2') {
                $role = $role[$sesi->idLevel - 1];

                foreach ($role as $r) {
                    if ($r == $route) {
                        return view($view, $passing);
                    } else {
                        continue;
                    }
                }
                return redirect()->route('dashboard');
            } else if ($sesi->idLevel == '3') {
                $role = $role[$sesi->idLevel - 1];

                foreach ($role as $r) {
                    if ($r == $route) {
                        return view($view, $passing);
                    } else {
                        continue;
                    }
                }
                return redirect()->route('dashboard');
            }
        }
    } else if ($type == 'guest') {
        if (Session::has('userLogin')) {
            return redirect()->route('dashboard');
        } else {
            return view($view, $passing);
        }
    }
}
