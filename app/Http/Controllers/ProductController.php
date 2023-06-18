<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Size;

class ProductController extends Controller
{
    public function __invoke(Product $product)
    {
        $product->load(['productColorSizes.color', 'productColorSizes.size']);

        $sizes = Size::pluck('name');

        $productSizingTable = $product->productColorSizes->groupBy('color.name');

        return view('products.show',
            compact('product', 'productSizingTable', 'sizes'));
    }
}
