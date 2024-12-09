<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class ProductController extends Controller
{
    public function store(Request $request)
{
        //Validate the request
        $validated = $request->validate([
            'productname' => 'required',
            'category' => 'required',
            'price' => 'required',
            'stockquantity' => 'required',
            'description' => 'required',
            'manufacturer' => 'required',
        ]);

        // Use the validated data to create a student
        $product = Product::create($validated);

        //Redirected back with success message
        return redirect()->route('dashboard')->with([
            'success' => 'Product added successfully',
            'newProduct' => $product,
        ]);

}

public function destroy(Product $product)
{
    $product->delete();
    return redirect()->route('dashboard')->with('delete', 'Product deleted successfully');
}

public function edit(Product $product)
{
    return view('edit-product', compact('product'));
}

public function update(Request $request, Product $product)
{
    $validated = $request->validate([
        'productname' => 'required',
        'category' => 'required',
        'price' => 'required',
        'stockquantity' => 'required',
        'description' => 'required',
        'manufacturer' => 'required',

    ]);

    $product->update($validated);

    return redirect()->route('dashboard')->with('success', 'Product updated Successfully');
}

}
