<?php

use Illuminate\Database\Seeder;
use App\ProductCategory;
use App\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductCategory::create([
            'name' => 'Islamic',
            'description' => '',
            'business_id' => 1
        ]);

        Product::create([
            'name' => 'Gown A',
            'stock' => 25,
            'price' => 156000.00,
            'business_id' => 1,
            'active' => 1,
            'product_category_id' => 1
        ]);
    }
}
