<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

use App\Models\User;
use App\Models\Question;
use App\Models\Registro;
use App\Models\Compra;

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
        $compras = [];
        if(Auth::user() != null){
            $compras = Compra::searchu(Auth::user()->id)->get();
            switch (Auth::user()->rol) {
                case 'Cliente':
                    # PROPIOS
                    $user = 'Cliente';
                    if(Auth::user()->estado == 'Comprador'){
                        $products = Product::aceptados()->get();//Concesionados;
                    }else{
                        $compras = Compra::all();
                        $products = Product::propios(Auth::user()->id)->get();//Propiod;
                    }
                    break;
                case 'Encargado':
                    # propuestos
                    $user = 'Encargado';
                    $products = Product::propuestos()->get();//Productos::propuestos()->get();
                    break;
                case 'Supervisor':
                    # todos
                    $user = 'Supervisor';
                    $products = Product::aceptadosrechazados()->get();
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
        return view('product.index', compact('products', 'i', 'categories','user','compras'));
    }

    public function indexCategory(Request $request,$id_category)
    {
        $compras = [];
        if(Auth::user() != null){
            $compras = Compra::searchu(Auth::user()->id)->get();
            if($request->input('name') != ''){
                if(Auth::user()->rol == 'Encargado') {
                    $products = Product::propuestos()->name($request->input('name'))->get();
                } else {
                    if(Auth::user()->estado == 'Comprador'){
                        if(Auth::user()->rol == 'Supervisor'){
                            $products = Product::aceptadosrechazados()->name($request->input('name'))->get();//Concesionados;
                        }else{
                            $products = Product::aceptados()->get();
                        }//Concesionados;
                    }else{
                        $compras = Compra::all();
                        $products = Product::propios(Auth::user()->id)->name($request->input('name'))->get();//Propiod;
                    }
                }
                $user = Auth::user()->rol;
            } else {
                if ($request->input('categoria') == 'All Categories') {
                    if(Auth::user()->rol == 'Encargado') {
                        $products = Product::propuestos()->get();
                    } else {
                        if(Auth::user()->estado == 'Comprador'){
                            if(Auth::user()->rol == 'Supervisor'){
                                $products = Product::aceptados()->rechazados()->get();//Concesionados;
                            }else{
                                $products = Product::aceptados()->get();
                            }
                        }else{
                            $compras = Compra::all();
                            $products = Product::propios(Auth::user()->id)->get();//Propiod;
                        }
                    }
                    $user = Auth::user()->rol;
                } else {
                    switch (Auth::user()->rol) {
                        case 'Cliente':
                            # PROPIOS
                            $user = 'Cliente';
                            $category = Category::category($request->input('categoria'))->first();
                            if($category != null){
                                $id_category = $category->id;
                            }
                            if(Auth::user()->estado == 'Comprador'){
                                $products = Product::aceptados()->category($id_category)->get();//Concesionados;
                            }else{
                                $compras = Compra::all();
                                $products = Product::propios(Auth::user()->id)->category($id_category)->get();//Propiod;
                            }
                            break;
                        case 'Encargado':
                            # propuestos
                            $user = 'Encargado';
                            $category = Category::category($request->input('categoria'))->first();
                            if($category != null){
                                $id_category = $category->id;
                            }
                            $products = Product::propuestos()->category($id_category)->get();
                            break;
                        case 'Supervisor':
                            # todos
                            $user = 'Supervisor';
                            $category = Category::category($request->input('categoria'))->first();
                            if($category != null){
                                $id_category = $category->id;
                            }
                            $products = Product::aceptadosrechazados()->category($id_category)->get();
                            break;
                        case 'Contador':
                            # code...
                            $user = 'Contador';
                            $products = [];
                            break;
                    }
                }
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
        return view('product.index', compact('products', 'i', 'categories','user','compras'));
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
        $categories = Category::aceptados()->get();
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
            $nombre_de_archivo = time().'.'.$imagen->getClientOriginalExtension();
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
        $com = [];
        $compra = [];
        $l = 1;
        $compras = Compra::search($id)->get();
        $category = Category::where('id',$product->category_id)->first();
        $questions = Question::where('product_id',$id)->paginate(10);
        if(Auth::user() != null){
            $com = Compra::searchu(Auth::user()->id)->search($id);
            $compra = $com->first();
        }

        return view('product.show', compact('product', 'category', 'questions','compras','l','compra'));
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
        $categories = Category::aceptados()->get();//where('activa',1)->get();
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

        $product=Product::find($id);
        $imagen = $request->file('imagen');
        $nombre_imagen = $product->imagen;
        if(!is_null($imagen)){
            unlink(public_path('fotos/products/'.$nombre_imagen));
            $ruta_destino = public_path('fotos/products/');
            $nombre_de_archivo = time().'.'.$imagen->getClientOriginalExtension();
            $imagen->move($ruta_destino,$nombre_de_archivo);
            $product['imagen']= $nombre_de_archivo;
        }
        $product->name = $request->name;
        $product->descripcion = $request->descripcion;
        $product->existencia = $request->existencia;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->concesionado = null;
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
        $product=Product::find($id);
        $path = $product->imagen;
        unlink(public_path('fotos/products/'.$path));
        $questions = Question::qproduct($id);
        foreach($questions as $question){
            Question::destroy($question->id);
        }
        $registros = Registro::rproduct($id);
        foreach($registros  as $registro){
            Registro::destroy($registro->id);
        }
        Product::destroy($id);

        return redirect()->route('products.index');
    }

    public function consignar(Request $request,$id){
        $seleccionado = Product::find($id);
        if ($request->porcentaje) {
            $seleccionado->porcentaje = $request->input('porcentaje');
            $this->authorize('consignar',$seleccionado);
            $seleccionado->concesionado=true;
            event(new ProductConcesionado($seleccionado));
        } else {
            $seleccionado->motivo = $request->input('motivo');
            $seleccionado->concesionado = 0;
        }
        $seleccionado->save();

        return redirect('products');
    }
}
