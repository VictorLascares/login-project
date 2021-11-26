<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Symfony\Component\VarDumper\VarDumper;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(Auth::user() != null){
            switch (Auth::user()->rol) {
                case 'Cliente':
                    # PROPIOS
                    $user = 'Cliente';
                    $categories = Category::aceptados()->get();//Auth::user()->productos;
                    break;
                case 'Encargado':
                    # propuestos
                    $user = 'Encargado';
                    $categories = Category::aceptados()->get();//Productos::propuestos()->get();
                    break;
                case 'Supervisor':
                    # todos
                    $user = 'Supervisor';
                    $categories = Category::all();
                    break;
                case 'Contador':
                    # code...
                    $user = 'Contador';
                    $categories = [];
                    break;
            }
        }else{
            $user = 'Anonimo';
            $categories = Category::aceptados()->get();
        }

        $i = 1;
        return view('category.index', compact('categories', 'i','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Create new category
        // $category = new Category();
        // echo('hola');
        return view('category.create');
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
        Category::create($request->all());
        return redirect()->route('categories.index');
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
        $category = Category::find($id);
        return view('category.show', compact(('category')));
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
        $category = Category::find($id);
        return view('category.edit', compact(('category')));
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
        $category=Category::find($id);
        $category->name = $request->input('name');
        $category->active = $request->input('active',0);
        $category->save();
        return redirect()->route('categories.index');
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
        $category=Category::find($id)->delete();
        return redirect()->route('categories.index');
    }
}
