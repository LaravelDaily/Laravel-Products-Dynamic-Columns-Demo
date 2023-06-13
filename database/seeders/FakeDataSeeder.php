<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use Illuminate\Database\Seeder;
use Str;

class FakeDataSeeder extends Seeder
{
    public function run()
    {
        $sizes = [
            'XS',
            'S',
            'M',
            'L',
            'XL',
            'XXL',
        ];

        foreach ($sizes as $size) {
            ProductSize::create(['name' => $size]);
        }

        $colors = [
            'Red',
            'Blue',
            'Green',
            'Yellow',
            'Black',
            'White',
        ];

        foreach ($colors as $color) {
            ProductColor::create(['name' => $color]);
        }

        $products = collect([
            'T-Shirt',
            'Polo Shirt',
            'Hoodie',
            'Sweatshirt',
            'Jacket',
            'Jeans',
            'Trousers',
        ]);

        for ($i = 0; $i <= 10; $i++) {
            Product::create([
                'name' => $products->random(),
                'code' => random_int(1, 1000)
            ]);
        }

        foreach (Product::all() as $product) {
            foreach (ProductColor::pluck('name', 'id') as $color => $colorName) {
                $usedSizes = [];
                for ($i = 0; $i < random_int(0, 6); $i++) {
                    $size = ProductSize::whereNotIn('id', $usedSizes)->get()->random();
                    if ($size && $color) {
                        $usedSizes[] = $size->id;
                        $product->productColorSizes()->create([
                            'size_id' => $size->id,
                            'color_id' => $color,
                            'reference_number' => Str::of($product->code)->append(
                                '-',
                                Str::of($colorName)
                                    ->limit(2, '')
                                    ->upper(),
                                '-',
                                Str::of($size->name)
                                    ->upper(),
                            )
                        ]);
                    }
                }
            }
        }
    }
}
