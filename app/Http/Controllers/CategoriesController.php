<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Redirect;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categories::all();
        return view('categorias.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categorias.create');
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
            $category = new Categories();
            $this->validate($request, [
                'name' => 'required',
                'description' => 'required',
                'icon' => 'mimes:png',
            ]);
            $category->name = $request->name;
            $category->description = $request->description;

            if ($request->hasFile('file_0')) {
                $fileNameWithExt = $request->file('file_0')->getClientOriginalName();
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('file_0')->guessClientExtension();
                $fileNameToStore = $fileName.'-'.time() . '.' .$extension;
                $path = $request->file('file_0')->storeAs('public/uploads/photos', $fileNameToStore);
            } else {
                $fileNameToStore = "noimagen.jpg";
            }
            $category->icon = $fileNameToStore;
            $category->save();
            DB::commit();
            return Redirect::route('categories');
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
         $category = Categories::find($id);
         return view('categorias.show', compact('category'));
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
         $category = Categories::find($id);
         return view('categorias.edit', compact('category'));
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
            $category = Categories::findOrFail($request->id);
            $this->validate($request, [
                'name' => 'required',
                'description' => 'required',
                'icon' => 'mimes:png',
            ]);
            $category->name = $request->name;
            $category->description = $request->description;

            if ($request->hasFile('file_0')) {
                $fileNameWithExt = $request->file('file_0')->getClientOriginalName();
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('file_0')->guessClientExtension();
                $fileNameToStore = $fileName.'-'.time() . '.' .$extension;
                $path = $request->file('file_0')->storeAs('public/uploads/photos', $fileNameToStore);
            } else {
                $fileNameToStore = $request->category_icon_actualy;
            }
            $category->icon = $fileNameToStore;
            $category->save();
            DB::commit();
            return Redirect::route('categories');
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
                $category = Categories::where('id', '=', $request->id )->delete();
            DB::commit();
            return response()->json( $category, 200 );
        } catch ( Exception $e ) {
            DB::rollBack();
            return response()->json($e, 200 );
        }
    }

    //rduarte funcion para obtener la lista de las categorias
    public function list(Request $request) {
        $categories = Categories::all();
        return response()->json( $categories, 200 );
    }
}
