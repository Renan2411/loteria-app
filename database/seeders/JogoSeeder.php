<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JogoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $toInsert = array(
            array(
                'name' => 'MegaSena',
                'number_quantity' => 60,
                'minimo' => 4,
                'maximo' => 6
            ),
            array(
                'name' => 'Quina',
                'number_quantity' => 80,
                'minimo' => 2,
                'maximo' => 5
            ),
            array(
                'name' => 'Lotofacio',
                'number_quantity' => 25,
                'minimo' => 11,
                'maximo' => 15
            )
        );

        DB::table('jogos')->insert($toInsert);
    }
}
