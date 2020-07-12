<?php

use Illuminate\Database\Seeder;
use App\ProductsAttribute;

class ProductsAttributesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productAttributesRecords = [
            ['id'=>1,
            'product_id' => 1,
            'size' => 'small',
            'price' => 1200,
            'stock' => 10,
            'sku' => 'NN001-S',
            'status' => 1],
            ['id'=>2,
            'product_id' => 2,
            'size' => 'small',
            'price' => 1200,
            'stock' => 15,
            'sku' => 'BN001-S',
            'status' => 1],
            ['id'=>3,
            'product_id' => 4,
            'size' => 'small',
            'price' => 1200,
            'stock' => 15,
            'sku' => 'BNHN001-S',
            'status' => 1]
        ];

        ProductsAttribute::insert($productAttributesRecords);
    }
}
