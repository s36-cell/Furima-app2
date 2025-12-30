<?php

namespace App\Http\Controllers;

use App\Models\Item;

class ProductController extends Controller
{
    public function index()
    {
        $products = Item::latest()->get();

        return view('products.index', compact('products'));
    }
}