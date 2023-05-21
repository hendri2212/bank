<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('customers')->insert([
            // 'nisn' => '0055825565',
            // 'nisn' => '0044696210',
            // 'nisn' => '0057586224',
            'nisn' => '0065395609',
            // 'username' => Str::random(10).'@gmail.com',
            'password' => Hash::make('password'),
            "created_at" =>  \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now()
        ]);
    }
}
