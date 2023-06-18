<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Color;
use App\Models\Size;
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
            Size::create(['name' => $size]);
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
            Color::create(['name' => $color]);
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

        $productColors = Color::pluck('name', 'id');
        $productSizes = Size::all();

        for ($i = 1; $i <= 10; $i++) {
            $product = Product::create([
                'name' => $products->random(),
                'code' => rand(1, 1000)
            ]);

            foreach ($productColors as $colorId => $colorName) {
                $usedSizes = [];
                for ($j = 0; $j < rand(0, 6); $j++) {
                    $size = $productSizes->whereNotIn('id', $usedSizes)->random();
                    if ($size && $colorId) {
                        $usedSizes[] = $size->id;
                        $product->productColorSizes()->create([
                            'size_id' => $size->id,
                            'color_id' => $colorId,
                            'reference_number' => str($product->code)->append(
                                '-',
                                str($colorName)
                                    ->limit(2, '')
                                    ->upper(),
                                '-',
                                str($size->name)
                                    ->upper(),
                            )
                        ]);
                    }
                }
            }
        }
    }
}
