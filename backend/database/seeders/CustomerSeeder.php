<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Number;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('customers')->insert([
            'id' => Number::random(1),
            // 'name' => Str::random(10),
            // 'email' => Str::random(10).'@gmail.com',
            // 'password' => Hash::make('password'),
        ]);
    }
}
