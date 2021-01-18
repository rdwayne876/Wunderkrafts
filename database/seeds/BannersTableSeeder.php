<?php

use Illuminate\Database\Seeder;
use App\Banner;

class BannersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bannerRecords = [
            ['id'=>1, 'image'=>'banner1.jpg', 'link'=>'', 'subtitle'=>'MAKE YOUR HAND!', 'title_one'=>'New Trending', 'title_two'=>'Collection', 'text'=>'Template price 25', 'status'=>1],
            ['id'=>2, 'image'=>'banner2.jpg', 'link'=>'', 'subtitle'=>'MAKE YOUR HAND!', 'title_one'=>'New Trending', 'title_two'=>'Collection', 'text'=>'Template price 25', 'status'=>1],
            ['id'=>3, 'image'=>'banner3.jpg', 'link'=>'', 'subtitle'=>'MAKE YOUR HAND!', 'title_one'=>'New Trending', 'title_two'=>'Collection', 'text'=>'Template price 25', 'status'=>1]
        ];

        Banner::insert($bannerRecords);
    }
}
