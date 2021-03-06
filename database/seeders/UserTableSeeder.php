<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Gianni',
            'email' => 'admin@admin.com',
            'password' => Hash::make('testtest'),
        ]);

        // create 10 random user accounts:
        \App\Models\User::factory(10)->create();
    }
}
