<?php

namespace App\Http\Controllers;

class ProductController extends Controller
{
    public function index()
    {
        return view('products.index');
    }

    public function show(string $productId)
    {
        return view('products.show', compact('productId'));
    }
}
