<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

use App\Models\Products;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $query = Products::select([
            'id',
            'name',
            'price'
        ])->get();

        return Inertia::render('Products/Index', [
            'productos' => $query,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('Products/CreateProduct');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);

        $product = new Products;
 
        $product->name = $request->name;

        $product->price = $request->price;
 
        $product->save();
 
        return Redirect::route('productos.index');


        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'price' => 'required|numeric',
        // ]);

        // $query = Products::create([
        //     'name' => $request->name,
        //     'price' => $request->price
        // ]);

        // $query->save();

        // return Redirect::route('productos.index');
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
    public function edit(string $id)
    {
        $query = Products::select([
            'id',
            'name',
            'price'
        ])
            ->where('id', '=', $id)
            ->get()
            ->toArray();

        return Inertia::render('Products/EditProduct', [
            'producto' => $query[0],
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);

        $product = Products::find($id);
 
        $product->name = $request->name;
        
        $product->price = $request->price;
 
        $product->save();
 
        return Redirect::route('productos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $flight = Products::find($id);
 
        $flight->delete();
    }
}
