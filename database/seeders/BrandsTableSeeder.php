<?php

use Illuminate\Database\Seeder;
use App\Brand;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brandRecords = [
            ['id'=>1, 'name' => 'WunnderKrafts', 'status'=>1],
            ['id'=>2, 'name' => 'Anime.com', 'status'=>1],
            ['id'=>3, 'name' => 'Weaboo', 'status'=>1],
            ['id'=>4, 'name' => 'Moon Kollection', 'status'=>1],
            ['id'=>5, 'name' => 'Get Creative', 'status'=>1],
        ];

        Brand::insert($brandRecords);
    }
}
