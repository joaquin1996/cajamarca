<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Places;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Redirect;

class PlacesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $places = Places::all();
        return view('places.index', compact('places'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('places.create');
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
            $place = new Places();
            $this->validate($request, [
                'name' => 'required',
                'description' => 'required',
            ]);
            $place->name = $request->name;
            $place->description = $request->description;
            $place->status = 0;
            $place->save();
            DB::commit();
            return Redirect::route('places');
        } catch(Exception $e) {
            DB::rollBack();
            return response()->json( $e, 200 );
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
        //retorn de la informacion
        $place = Places::find($id);
        return view('places.show', compact('place'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //retorn de la informacion
        $place = Places::find($id);
        return view('places.edit', compact('place'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
    		DB::beginTransaction();
            $place = Places::findOrFail($request->id);
            $this->validate($request, [
                'name' => 'required',
                'description' => 'required',
            ]);
            $place->name = $request->name;
            $place->description = $request->description;
            $place->status = $request->status;
            $place->save();
            DB::commit();
            return Redirect::route('places');
        } catch(Exception $e) {
            DB::rollBack();
            return response()->json( $e, 200 );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            DB::beginTransaction();
            $place = Places::where('id', '=', $request->id )->delete();
            DB::commit();
            return response()->json( $place, 200 );
        } catch ( Exception $e ) {
            DB::rollBack();
            return response()->json($e, 200 );
        }
    }
}
