<?php

namespace App\Http\Controllers;

use App\Models\Messages;
use App\Models\Notes;
use Illuminate\Http\Request;

class FileController extends Controller
{
    //

    public function store(Request $request){

        dd('y');


        if($request->hasFile('upload')){
        }



    }

}
