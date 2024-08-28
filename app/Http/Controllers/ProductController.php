<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /**
         * TODO: Implement the store method
         * Return redirect to list of products pages with a success message
         */
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'image' => 'required'
        ]);

        $validatedData['image'] = $request->file('image')->store('images');

        // Product::create($validatedData);
        Product::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'stock' => $validatedData['stock'],
            'image' => $validatedData['image'],
        ]);

        return redirect()->route('products.index')->with('success', 'New Product Successfully Added');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        /**
         * TODO: Implement the edit method
         * return a view with the product data, view name is products.edit
         */
        return view('products.edit', [
            'product' => $product
        ]); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        /**
         * TODO: Implement the update method
         * Return redirect to list of products pages with a success message
         */
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        /**
         * TODO: Implement the destroy method
         * should delete the image from the storage
         * Return redirect to list of products pages with a success message
         */

    }
}
