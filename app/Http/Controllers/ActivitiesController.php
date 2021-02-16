<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activities;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    // guardar imagen con dropzone
    public function save_image(Request $request) {
                   
        foreach ($request->file('file') as $item) {
            $file = $item;
            $name = time().$file->getClientOriginalName();
            //guardar imagen
            $file->move(public_path().'/uploads/photos',$name);
                                      
            # guardar registro en la base de datos
            /* $insertar = new modelo();
            $insertar->id_actividad = $request->id;
            $insertar->photo = $name;
            $insertar->save();  */
        }

        return Response($request->id);
       
    }
}
