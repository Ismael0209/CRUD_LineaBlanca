<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //consultar la información
      
         $datos['articulos']=Articulo::paginate(5);
         return view('articulo.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articulo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $campos=[
            'Articulo'=>'required|string|max:100',
            'Cantidad'=>'required|int|max:100',
            'Caducidad'=>'required|string|max:100',
            'Precio'=>'required|string|max:12',
            'Foto'=>'required|max:10000|mimes:jpeg,png,jpg',
        ];

        $mensaje=[
                'required'=>'El :attribute es requerido',
                'Foto.required'=>'La foto es requerida'
        ];

        $this->validate($request,$campos,$mensaje);


        $datosArticulo = request()->except('_token');

        //con esta condicional cambiamos el archivo y lo guardamos para poder tener guardada la foto como .jpj
        if($request->hasFile('Foto')){
            $datosArticulo['Foto']=$request->file('Foto')->store('uploads','public');
        }

        Articulo::insert($datosArticulo);
        return redirect('articulo')->with('mensaje','Articulo agregado con exito');
       // return response()->json($datosArticulo);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function show(Articulo $articulo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $articulo=Articulo::findOrFail($id);
        return view('articulo.edit',compact('articulo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $campos=[
            'Articulo'=>'required|string|max:100',
            'Cantidad'=>'required|int|max:100',
            'Caducidad'=>'required|string|max:100',
            'Precio'=>'required|string|max:12',    
        ];

        $mensaje=[
                'required'=>'El :attribute es requerido',      
        ];


        if($request->hasFile('Foto')){
            $campos=['Foto'=>'required|max:10000|mimes:jpeg,png,jpg'];
            $mensaje=['Foto.required'=>'La foto es requerida'];
        }

        $this->validate($request,$campos,$mensaje);

        $datosArticulo = request()->except(['_token','_method']);
        
        if($request->hasFile('Foto')){
            $articulo=Articulo::findOrFail($id);
            Storage::delete('public/'.$articulo->Foto);
            $datosArticulo['Foto']=$request->file('Foto')->store('uploads','public');
        }
        
        
        Articulo::where('id','=',$id)->update($datosArticulo);

        $articulo=Articulo::findOrFail($id);
        //return view('empleado.edit',compact('empleado'));
        return redirect('articulo')->with('mensaje','Articulo Modificado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $articulo=Articulo::findOrFail($id);
        if(Storage::delete('public/'.$articulo->Foto)){
            Articulo::destroy($id);
        }

        
        return redirect('articulo')->with('mensaje','Articulo Borrado');
    }
}