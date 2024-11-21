<?php

namespace Database\Seeders;

use App\Models\Rubro;
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
        
      // si quiero crear un admin ya por defecto 
        \App\Models\User::factory(1)->create([
            'name' => 'admin',
            'email' => 'karol1770@hotmail.com',
            'password' => bcrypt('karol123'),
            'role' => 'admin',
        ]);

        $this->call([
            SupervisorSeeder::class,
            DepartamentoSeeder::class,
            CargosSeeder::class,
            RubroSeeder::class,
            ParametrosSeeder::class,
            
        ]);



        


     

    }
}
