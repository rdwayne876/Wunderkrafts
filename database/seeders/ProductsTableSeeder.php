<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productRecords = [
            ['id' => 1,
                'category_id' => 8,
                'section_id' => 1,
                'name' => 'naruto necklace',
                'code' => 'NN001',
                'color' => 'red',
                'price' => 800.00,
                'discount' => 0,
                'size' => 'small',
                'video' => '',
                'main_image' => '',
                'description' => 'Naruto themed necklace',
                'meta_title' => '',
                'meta_description' => '',
                'meta_keywords' => '',
                'featured' => 'No',
                'status' => 1
            ],
            ['id' => 2,
                'category_id' => 8,
                'section_id' => 1,
                'name' => 'Bleach necklace',
                'code' => 'BN001',
                'color' => 'blue',
                'price' => 800.00,
                'discount' => 0,
                'size' => 'small',
                'video' => '',
                'main_image' => '',
                'description' => 'Bleach themed necklace',
                'meta_title' => '',
                'meta_description' => '',
                'meta_keywords' => '',
                'featured' => 'Yes',
                'status' => 1
            ]
        ];

        Product::insert($productRecords);
    }
}
