<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

//menambahkan use yang dibutuhkan
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


     // Validasi input sebelum mengubah data di database
     $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric',
        'stock' => 'required|integer',
        'image' => 'sometimes|url|max:2048', // Validasi URL gambar
    ]);

    // Jika ada URL gambar baru, update data produk
    if ($request->filled('image')) {
        // Hapus gambar lama jika ada
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        // Set gambar baru ke data produk
        $validated['image'] = $request->image;
    }

    // Update produk dengan data yang telah divalidasi
    $product->update($validated);

    // Redirect ke halaman daftar produk dengan pesan sukses
    return redirect()->route('products.index')
        ->with('success', 'Produk berhasil diperbarui.');

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

         // Hapus gambar produk dari storage jika ada
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        // Hapus produk dari database
        $product->delete();

        // Redirect ke halaman daftar produk dengan pesan sukses
        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil dihapus.');

    }
}
