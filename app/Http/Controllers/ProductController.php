<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

use App\Models\User;
use App\Models\Question;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Events\ProductConcesionado;
use App\Observers\ProductObserver;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user() != null){
            switch (Auth::user()->rol) {
                case 'Cliente':
                    # PROPIOS
                    $user = 'Cliente';
                    $products = Product::aceptados()->get();//Auth::user()->productos;
                    break;
                case 'Encargado':
                    # propuestos
                    $user = 'Encargado';
                    $products = Product::propuestos()->get();//Productos::propuestos()->get();
                    break;
                case 'Supervisor':
                    # todos
                    $user = 'Supervisor';
                    $products = Product::aceptados()->get();
                    break;
                case 'Contador':
                    # code...
                    $user = 'Contador';
                    $products = [];
                    break;
            }
        }else{
            $user = 'Anonimo';
            $products = Product::aceptados()->get();
        }
        //
        //$products = Product::paginate();
        $i = 1;

        $categories = Category::all();
        return view('product.index', compact('products', 'i', 'categories','user'));
    }

    public function indexCategory(Request $request,$id_category)
    {
        if(Auth::user() != null){
            if($request->input('name') != ''){
                $products = Product::aceptados()->name($request->input('name'))->get();
            }else{
                if ($request->input('categoria') == 'All Categories') {
                    $products = Product::aceptados()->get();
                } else {
                    $products = Product::aceptados()->category($id_category)->get();
                }
            }
            switch (Auth::user()->rol) {
                case 'Cliente':
                    # PROPIOS
                    $user = 'Cliente';
                    break;
                case 'Encargado':
                    # propuestos
                    $user = 'Encargado';
                    break;
                case 'Supervisor':
                    # todos
                    $user = 'Supervisor';
                    break;
                case 'Contador':
                    # code...
                    $user = 'Contador';
                    $products = [];
                    break;
            }
        }else{
            $user = 'Anonimo';
            if($request->input('name') != ''){
                $products = Product::aceptados()->name($request->input('name'))->get();
            }else{
                if($id_category == '{null}'){
                    $products = Product::aceptados()->get();
                }else{
                    $products = Product::aceptados()->category($id_category)->get();
                }
            }
        }
        //
        //$products = Product::paginate();
        $i = 1;

        $categories = Category::all();
        return view('product.index', compact('products', 'i', 'categories','user'));
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
        $product = $request->all();
        $imagen = $request->file('imagen');
        if(!is_null($imagen)){
            $ruta_destino = public_path('fotos/products/');
            $nombre_de_archivo = $imagen->getClientOriginalName();
            $imagen->move($ruta_destino,$nombre_de_archivo);
            $product['imagen']= $nombre_de_archivo;
        }
        $product['user_id'] = Auth::user()->id;
        $registro = new Product();
        $registro->fill($product);
        $registro->save();

        return redirect('products');
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
        $questions = Question::where('product_id',$id)->paginate(10);
        return view('product.show', compact('product', 'category', 'questions'));
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

        $seleccionado->concesionado=true;

        $seleccionado->save();
        event(new ProductConcesionado($seleccionado));

        return redirect('products');
    }
}
