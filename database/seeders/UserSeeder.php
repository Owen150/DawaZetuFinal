<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            'name' => 'Admin Wambua',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'designation' => 'M',
            'employee_number' => 'EM 1234',
            'phone_number' => '+254715100539'
        ]);

        /*

        DB::table('users')->insert([
            'name' => 'County Pharmacist',
            'email' => 'cp@mail.com',
            'password' => Hash::make('admin123'),
            'role' => 'cp',
            'designation' => 'M',
            'employee_number'=> 'EM 1234',
            'phone_number' => '+25476891011'
        ]);

        DB::table('users')->insert([
            'name' => 'County Officer',
            'email' => 'co@mail.com',
            'password' => Hash::make('admin123'),
            'role' => 'co',
            'designation' => 'M',
            'employee_number'=> 'EM 1234',
            'phone_number' => '+25476891011'
        ]);
        

        DB::table('users')->insert([
            'name' => 'County Director',
            'email' => 'cd@mail.com',
            'password' => Hash::make('admin123'),
            'role' => 'cd',
            'designation' => 'M',
            'employee_number'=> 'EM 1234',
            'phone_number' => '+25476891011'
        ]);
        
        
        DB::table('users')->insert([
            'name' => 'Facility One',
            'email' => 'fone@mail.com',
            'password' => Hash::make('admin123'),
            'role' => 'hfp',
            'designation' => 'M',
            'employee_number'=> 'EM 1234',
            'phone_number' => '+25476891011',
            'facility_id' => 1
        ]);

        DB::table('users')->insert([
            'name' => 'Facility Two',
            'email' => 'ftwo@mail.com',
            'password' => Hash::make('admin123'),
            'role' => 'hfp',
            'designation' => 'M',
            'employee_number'=> 'EM 1234',
            'phone_number' => '+25476891011',
            'facility_id' => 2
        ]);
        */
        /*DB::table('users')->insert([
            'name' => 'Facility Three',
            'email' => 'fthree@mail.com',
            'password' => Hash::make('admin123'),
            'role' => 'hfp',
            'designation' => 'M',
            'employee_number'=> 'EM 3217',
            'phone_number' => '+25476891011',
            'facility_id' => 3
        ]);
        */
    }
}
