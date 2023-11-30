<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TotsUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tots_user')->insert([
            //'email' => Str::random(10).'@gmail.com',
            'email' => 'admin@tots.agency',
            'password' => Hash::make('123Qwerty')
        ]);

        // For example, let's create 50 users that each has one related post:
        /*User::factory()
            ->count(50)
            ->hasPosts(1)
            ->create();*/
    }
}
