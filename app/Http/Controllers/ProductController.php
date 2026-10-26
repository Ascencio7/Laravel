<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Product::select("productos.codigo", "productos.nombre", "productos.precio", "marcas.nombre as marca")
            ->join("marcas", "marcas.codigo", "=", "productos.marca")
            ->get();

        //dd($productos);

        return view('/products/show')->with(['productos' => $productos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $marcas = Branch::all();

        return view('/products/create')->with(['marcas' => $marcas]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'nombre' => 'required',
            'precio' => 'required',
            'marca' => 'required',
        ]);

        Product::create($data);

        return redirect('/products/show');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $producto)
    {
        $marcas = Branch::all();

        return view('/products/update')->with(['marcas' => $marcas, 'producto' => $producto]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $producto)
    {
        $data = request()->validate([
            'nombre' => 'required',
            'precio' => 'required',
            'marca' => 'required',
        ]);

        $producto->nombre = $data['nombre'];
        $producto->precio = $data['precio'];
        $producto->marca = $data['marca'];
        $producto->updated_at = now();

        $producto->save();

        return redirect('/products/show');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $producto)
    {
        $producto->delete();

        return response()->json(['success' => true]);
    }
}
