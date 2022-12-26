<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $administrator = Role::create(['name' => 'Administrador']);
        Role::create(['name' => 'Gestor']);

        Permission::create(['name' => 'user']);
        $administrator->givePermissionTo('user');
        
        $user = User::create([
            'name'      =>  env('ENV_NAME'),
            'password'  =>  Hash::make(env('ENV_PASSWORD'))
         ]);

        $user->assignRole('Administrador');
        $this->call(CompanySeeder::class);
        $this->call(DataSeeder::class);
        $this->call(PageSeeder::class);
        $this->call(SectionSeeder::class);
        $this->call(ContentSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ProductSeeder::class);
    }
}
