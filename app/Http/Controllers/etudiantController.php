<?php

namespace App\Http\Controllers;

use App\Models\etudiant;
use Illuminate\Http\Request;

class etudiantController extends Controller
{
    function get()
    {

       $Etudiant = etudiant::orderBy('created_at' ,'desc')->select()->get();
        return $Etudiant;

    }

    function add(Request $request)
    {
        $Etudiant = new etudiant();

        $Etudiant->name=$request->name;
        $Etudiant->email=$request->email;

        $Etudiant->save();

    }

    function update(Request $request)
    {
        $Etudiant = etudiant::where('id' ,$request->id)
            ->update(['name' => $request->name , 'email' => $request->email  ]);
    }

    function delete(Request $request)
    {
        $Etudiant = etudiant::where('id' ,$request->id)
            ->delete();
    }

}
