<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Coupon;

class CouponsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $couponRecords = [
            ['id'=>1, 'coupon_option'=> 'Manual', 'coupon_code'=> 'test10', 'categories'=> '1, 2', 'users'=> 'tishaunagreen@gmail.com',
             'coupon_type'=> 'single', 'amount_type' => 'Percentage', 'amount'=> '10', 'expire_date'=>'2021-12-31', 'status'=>1]
        ];

        Coupon::insert($couponRecords);
    }
}
