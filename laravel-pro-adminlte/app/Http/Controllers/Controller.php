<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function checkPermission($permission)
    {
        if (!auth()->user()->can($permission)) {
            abort(403, 'Acesso não autorizado');
        }
    }
}
