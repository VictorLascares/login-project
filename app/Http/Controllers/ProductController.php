<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Events\ProductConcesionado;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        switch (Auth::user()->rol) {
            case 'Cliente':
                # PROPIOS
                $products = Product::all();//Auth::user()->productos;
                break;
            case 'Encargado':
                # propuestos
                $products = Product::all();//Productos::propuestos()->get();
                break;
            case 'Supervisor':
                # todos
                $products = Product::all();
                break;
            case 'Contador':
                # code...
                $products = [];
                break;
        }
        //
        //$products = Product::paginate();
        $i = 1;
        $categories = Category::all();
        return view('product.index', compact('products', 'i', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $product = new Product();
        $categories = Category::all();
        return view('product.create', compact('product','categories'));
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
        $product = Product::create($request->all());
        return redirect()->route('products.index');
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
        $product = Product::find($id);
        $category = Category::where('id',$product->category_id)->first();
        return view('product.show', compact('product', 'category'));
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
        $product = Product::find($id);
        //$this->authorize('update',$seleccionado);
        $categories = Category::all();//where('activa',1)->get();
        return view('product.edit', compact('product', 'categories'));
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
        $product=Product::find($id);
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->category_id = $request->input('category_id');
        $product->save();
        return redirect()->route('products.index');
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
        $product=Product::find($id)->delete();
        return redirect()->route('products.index');
    }

    public function consignar($id){

        $seleccionado = Product::find($id);
        $this->authorize('consignar',$seleccionado);

        $seleccionado->consignado=true;

        $seleccionado->save();
        event(new ProductConcesionado($seleccionado));

        return redirect('product');
    }
}
