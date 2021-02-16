<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activities;
use App\Models\Points;
use Illuminate\Support\Facades\DB;
use Exception;

class ActivitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('lugares.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
    		DB::beginTransaction();
            $pointA = new Points();
            $this->validate($request, [
                'name' => 'alpha|required',
                'description' => 'alpha|required',
                'lon' => 'numeric',
                'lat' => 'numeric',
                'elevation' => 'numeric',
                'temp' => 'numeric',
                'temp_min' => 'numeric',
                'temp_max' => 'numeric',
            ]);
            $pointA->name = $request->data_origin_name;
            $pointA->description = $request->data_origin_description;
            $pointA->lon = $request->data_origin_lon;
            $pointA->lat = $request->data_origin_lat;
            $pointA->elevation = $request->data_origin_elevation;
            $pointA->temp = $request->data_origin_temp;
            $pointA->temp_min = $request->data_origin_temp_min;
            $pointA->temp_max = $request->data_origin_temp_max;
            $pointA->save();

            $pointB = new Points();
            $this->validate($request, [
                'name' => 'alpha|required',
                'description' => 'alpha|required',
                'lon' => 'numeric',
                'lat' => 'numeric',
                'elevation' => 'numeric',
                'temp' => 'numeric',
                'temp_min' => 'numeric',
                'temp_max' => 'numeric',
            ]);
            $pointB->name = $request->data_destination_name;
            $pointB->description = $request->data_destination_description;
            $pointB->lon = $request->data_destination_lon;
            $pointB->lat = $request->data_destination_lat;
            $pointB->elevation = $request->data_destination_elevation;
            $pointB->temp = $request->data_destination_temp;
            $pointB->temp_min = $request->data_destination_temp_min;
            $pointB->temp_max = $request->data_destination_temp_max;
            $pointB->save();

            $activity = new Activities();
            $this->validate($request, [
                'id_category' =>'numeric',
                'id_point_a' => 'numeric',
                'id_point_b' => 'numeric',
                'name' => 'alpha|required',
                'description' => 'alpha|required',
                'icon' => 'mimes:png',
                'distance' => 'numeric',
                'duration' => 'numeric',
                'dificulty' => 'numeric',
                'perfil' => 'alpha|required',
            ]);
            $activity->id_category = $request->category;
            $activity->id_point_a = $pointA->id;
            $activity->id_point_b = $pointB->id;
            $activity->name = $request->name;
            $activity->description = $request->description;

            if ($request->hasFile('file_0')) {
                $fileNameWithExt = $request->file('file_0')->getClientOriginalName();
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('file_0')->guessClientExtension();
                $fileNameToStore = $fileName.'-'.time() . '.' .$extension;
                $path = $request->file('file_0')->storeAs('public/uploads/photos', $fileNameToStore);
            } else {
                $fileNameToStore = "noimagen.jpg";
            }
            $activity->icon = $fileNameToStore;

            $activity->distance = $request->distance;
            $activity->duration = $request->duration;
            $activity->dificulty = $request->dificulty;
            $activity->perfil = $request->perfil;
            $activity->save();
            DB::commit();
            return response()->json( 'success', 200 );
        } catch(Exception $e) {
            return response()->json( $e, 200 );
            DB::rollBack();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //rduarte funcion para obtener la lista de las actividades
    public function list(Request $request) {
        $activities = Activities::all();
        return response()->json( $activities, 200 );
    }
}
