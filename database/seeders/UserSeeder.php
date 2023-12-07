<?php

namespace Database\Seeders;

use App\Models\User;
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
        //
        User::create([
            'name'=>'kahled1',
            'email'=>'k@abdalbasit.com',
            'password'=>Hash::make('password'),
            'phone_number'=> '01551555525',
        ]);

        // other methode to add seeder
        DB::table('users')->insert([
            'name' => 'system admin1',
            'email' => 'sys@abdalbasit.com',
            'password' => Hash::make('password'),
            'phone_number' => '01551555526',
        ]);
    }
}
