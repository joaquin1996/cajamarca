<?php

namespace App\Http\Controllers;

use App\Models\Activities;
use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Points;
use Illuminate\Support\Facades\DB;

class LugaresController extends Controller
{
    public function index()
    {
        $categories = Categories::all();
        $activities = Activities::all();
        return view('lugares.index', compact('categories', 'activities'));
    }

    //rduarte, esta funccion returna la vista con todos los datos del lugar
    public function show($id)
    {
        //retorn de la informacion
        $activity = Activities::find($id);
        $pointA = Points::find($activity->id_point_a);
        $pointB = Points::find($activity->id_point_b);
        return view('lugares.places', ['activity' => $activity, 'point_a' => $pointA, 'point_b' => $pointB]);
    }
}
