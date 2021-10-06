<?php

namespace App\Http\Controllers;

use App\Models\etudiant;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function add(Request $request)
    {
        $Etudiant = new User();

        $Etudiant->name=$request->name;
        $Etudiant->email=$request->email;
        $Etudiant->email=$request->email;
        $Etudiant->save();

    }
}
