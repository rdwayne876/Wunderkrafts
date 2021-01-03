<?php

use Illuminate\Database\Seeder;
use App\ProductsImage;

class ProductsImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productImageRecords = [
            ['id'=>1, 'product_id'=>1, 'image'=>'PAL-bracelet.png-49908.png', 'status'=>1]
        ];
        ProductsImage::insert($productImageRecords);
    }
}
