<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Parametro;

class ParametrosSeeder extends Seeder
{
    public function run()
    {
        $parametros = [
            ['nombre' => 'Resolución de problemas'],
            ['nombre' => 'inpuntualidad']

           
        ];

        foreach ($parametros as $parametro) {
            $parametroModel = new Parametro();
            $parametroModel->fill($parametro);
            $parametroModel->save();
        }
    }
}
