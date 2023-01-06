<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configurations')->insert(
            [
                'id'                    => 1,
                'name'                  => 'PetShop OLAKZ',
                'icon'                  => 'cats.png',
                'description'           => 'We serve payment by bank and e-wallet',
                'email'                 => 'ogeekzxz@gmail.com',
                'phone'                 => '082222222222',
                'address'               => 'Bla bla bla, Palembang',
                'facebook'              => 'https://facebook.com/nomercy0201',
                'instagram'             => 'https://instagram.com/prayogimhd',
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now(),
            ],
           );
    }
}
