<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();

        $adminRecords = [
            [
                'id' =>1, 
                'name' => 'Dwayne',
                'type' => 'admin',
                'mobile' => '8763547211',
                'email' => 'dwayne@admin.com',
                'password' => '$2y$10$ytJGrvEZ5hMX8WTSkVJbRuT1UMookGOjRyJlbeOn.RmUMUz1G2Ujq',
                'image' => '',
                'status' => 1
            ],
            
            [
                'id' =>2, 
                'name' => 'Tish',
                'type' => 'subadmin',
                'mobile' => '8763547211',
                'email' => 'tish@admin.com',
                'password' => '$2y$10$ytJGrvEZ5hMX8WTSkVJbRuT1UMookGOjRyJlbeOn.RmUMUz1G2Ujq',
                'image' => '',
                'status' => 1
            ],
        ];

        foreach ( $adminRecords as $key => $record ) {
            \App\Admin::create($record);
        }
    }
}
