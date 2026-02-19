<?php

namespace App\Http\Controllers;

use App\Builders\ProductBuilder;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class ProductController extends Controller
{
    public function createProduct(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'variants' => 'required|array',
            'shippingMethods' => 'required|array',
        ]);

        $product = (new ProductBuilder())
        ->setDetails($validated['details'])
        ->setVariants($validated['variants'])
        ->setShippingMethods($validated['shippingMethods'])
        ->build();

        return response()->json($product);
    }
}
