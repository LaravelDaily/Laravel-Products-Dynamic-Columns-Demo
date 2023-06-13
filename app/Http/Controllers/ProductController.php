<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductSize;

class ProductController extends Controller
{
    public function __invoke(Product $product)
    {
        $product->load(['productColorSizes', 'productColorSizes.color', 'productColorSizes.size']);

        $sizes = ProductSize::pluck('name');

        $productSizingTable = $product->productColorSizes->groupBy('color.name');

        return view('products.show')
            ->with('product', $product)
            ->with('productSizingTable', $productSizingTable)
            ->with('sizes', $sizes);
    }
}
