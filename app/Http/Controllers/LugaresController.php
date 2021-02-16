<?php

namespace App\Http\Controllers;

use App\Models\Activities;
use Illuminate\Http\Request;

class LugaresController extends Controller
{
    public function index()
    {
        return view('lugares.index');
    }

    //rduarte, esta funccion returna la vista con todos los datos del lugar
    public function show($id)
    {
        //retorn de la informacion
        $activity = Activities::find($id);
        return view('lugares.places', ['activity' => $activity]);
    }
}
