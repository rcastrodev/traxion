<?php

use App\Data;
use App\Company;
use Illuminate\Database\Seeder;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Data::create([
            'company_id'=> Company::first()->id,
            'address'   => 'Larrazábal 2352, C1440CVP, Buenos Aires',
            'email'     => 'traxion@red.com.ar',
            'phone1'    => '+541149182006|(54 11) 4918-2006',
            'phone2'    => '+541149186507|6507',
            'instagram' => '#',
            'facebook' => '#',
            'logo_header'=> 'images/data/image125.png',
        ]);
    }
}