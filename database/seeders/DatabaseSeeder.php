<?php

namespace Database\Seeders;

use App\Models\Catergory;
use App\Models\Product;
use App\Models\Store;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        //Store::factory(5)->create();
        //Catergory::factory(10)->create();
        //Product::factory(100)->create();
        //$this->call(UserSeeder::class);

        \App\Models\Admin::factory(3)->create();
    }
}
