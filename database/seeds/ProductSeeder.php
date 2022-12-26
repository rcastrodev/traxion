<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'category_id'   => 1,
            'code'          => '001',
            'name'          => 'Corona de arranque 1',
            'description'   => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis accusamus repellendus nemo illum sint totam repellat ipsa quia fugiat, atque vel in expedita consectetur, ullam veritatis maxime necessitatibus. Eos, ex.',
            'number_of_teeth'   => '120',
            'external_diameter' => '307',
            'inside_diameter'   => '270.5',
            'thickness'         => '10',
        ]);
    }
}




