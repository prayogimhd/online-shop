<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'categories_id'         => 1,
                'product_name'          => 'Meo Kitten',
                'product_descriptions'  => 'Cat Snack for Kitten',
                'slug'                  => 'meo-kitten',
                'thumbnails'            => 'meo.jpg',
                'price'                 => 23000,
                'weight'                => '60g',
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now(),
            ],
            [
                'categories_id'         => 1,
                'product_name'          => 'Temptations Kitten',
                'product_descriptions'  => 'Cat Snack for Kitten',
                'slug'                  => 'temptations-kitten',
                'thumbnails'            => 'temptations.png',
                'price'                 => 25000,
                'weight'                => '60g',
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now(),
            ],
            [
                'categories_id'         => 3,
                'product_name'          => 'Whiskas Adult',
                'product_descriptions'  => 'Wet Food for Adult',
                'slug'                  => 'whiskas-adult',
                'thumbnails'            => 'whiskas.jpg',
                'price'                 => 22000,
                'weight'                => '400g',
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now(),
            ],
             [
                'categories_id'         => 1,
                'product_name'          => 'Friskies',
                'product_descriptions'  => 'Cat Snack for Kitten',
                'slug'                  => 'friskies',
                'thumbnails'            => 'friskies.jpg',
                'price'                 => 24500,
                'weight'                => '60g',
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now(),
            ]
        ]);
    }
}
