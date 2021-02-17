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
}
