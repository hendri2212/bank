<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('users')->insert([
            'name'              => 'Hendri Arifin',
            // 'email'          => Str::random(10).'@gmail.com',
            'email'             => 'arifin.hendri465@gmail.com',
            'email_verified_at' => \Carbon\Carbon::now(),
            'password'          => Hash::make('administrator'),
            'role'              => 'superadmin',
            // 'remember_token' => User::createToken('ok'),
            // 'remember_token' => User::createToken('ok')->plainTextToken,
            // 'remember_token' => User::createToken('tokenForTest',["read"])->plainTextToken,
            "created_at"        =>  \Carbon\Carbon::now(),
            "updated_at"        => \Carbon\Carbon::now()
        ]);
        // user::createToken('ok');
    }
}
