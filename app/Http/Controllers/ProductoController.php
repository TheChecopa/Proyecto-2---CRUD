<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $datos['productos']=Producto::paginate(5);
        return view('productos.index', $datos);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('productos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    

    public function store(Request $request)
    {

        $campos=[
            'Nombre'=>'required|string|max:50',
            'Descripcion'=>'required|string|max:500',
            'Foto'=>'required|max:100000|mimes:jpeg,png,jpg',
        ];
        $mensaje=[
                'Nombre.required'=>'El nombre es requerido',
                'Descripcion.required'=>'La descripcion es requerida',
                'Foto.required'=>'La foto es requerida',
                
        ];
    
        $this->validate($request, $campos, $mensaje);

        $datosProducto = request()->except('_token');

        if($request->hasFile('Foto')){
            $datosProducto['Foto']=$request->file('Foto')->store('uploads', 'public');
        }

        Producto::insert($datosProducto);

        //return response()->json($datosProducto);  
        return redirect('productos')->with('mensaje','Producto agregado con exito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $productos=Producto::findOrFail($id);
        return view('productos.edit', compact('productos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $campos=[
            'Nombre'=>'required|string|max:50',
            'Descripcion'=>'required|string|max:500',
        ];
        $mensaje=[
                'Nombre.required'=>'El nombre es requerido',
                'Descripcion.required'=>'La descripcion es requerida',     
        ];
        if($request->hasFile('Foto')){
            $campos=['Foto'=>'required|max:100000|mimes:jpeg,png,jpg',];
            $mensaje=['Foto.required'=>'La foto es requerida',];
        }
        $this->validate($request, $campos, $mensaje);
        //
        $datosProducto = request()->except(['_token','_method']);

        if($request->hasFile('Foto')){
            $productos=Producto::findOrFail($id);
            Storage::delete('public/'.$productos->Foto);
            $datosProducto['Foto']=$request->file('Foto')->store('uploads', 'public');
        }

        Producto::where('id','=',$id)->update($datosProducto);
        $productos=Producto::findOrFail($id);
        //return view('productos.edit', compact('productos'));
        return redirect('productos')->with('mensaje','Producto modificado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $productos=Producto::findOrFail($id);

        if(Storage::delete('public/'.$productos->Foto)){
            Producto::destroy($id);
        }
        
        return redirect('productos')->with('mensaje','Producto borrado');
    }
}
