<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\PseudoTypes\True_;

class PriceSeeder extends Seeder
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
                'jogo_id' => 1,
                'quantidade' => 6,
                'valor' => 4.5,
                'maximo' => false
            ),
            array(
                'jogo_id' => 1,
                'quantidade' => 7,
                'valor' => 31.5,
                'maximo' => false
            ),
            array(
                'jogo_id' => 1,
                'quantidade' => 8,
                'valor' => 126,
                'maximo' => false
            ),
            array(
                'jogo_id' => 1,
                'quantidade' => 9,
                'valor' => 378,
                'maximo' => true
            ),
            array(
                'jogo_id' => 2,
                'quantidade' => 5,
                'valor' => 1.5,
                'maximo' => false
            ),
            array(
                'jogo_id' => 2,
                'quantidade' => 6,
                'valor' => 9,
                'maximo' => false
            ),
            array(
                'jogo_id' => 2,
                'quantidade' => 7,
                'valor' => 31.5,
                'maximo' => false
            ),
            array(
                'jogo_id' => 2,
                'quantidade' => 8,
                'valor' => 84,
                'maximo' => false
            ),
            array(
                'jogo_id' => 2,
                'quantidade' => 9,
                'valor' => 189,
                'maximo' => false
            ),
            array(
                'jogo_id' => 2,
                'quantidade' => 10,
                'valor' => 378,
                'maximo' => false
            ),
            array(
                'jogo_id' => 2,
                'quantidade' => 11,
                'valor' => 693,
                'maximo' => false
            ),
            array(
                'jogo_id' => 2,
                'quantidade' => 12,
                'valor' => 1188,
                'maximo' => false
            ),
            array(
                'jogo_id' => 2,
                'quantidade' => 13,
                'valor' => 1930.5,
                'maximo' => false
            ),
            array(
                'jogo_id' => 2,
                'quantidade' => 14,
                'valor' => 3003,
                'maximo' => false
            ),
            array(
                'jogo_id' => 2,
                'quantidade' => 15,
                'valor' => 4504.5,
                'maximo' => true
            ),
            array(
                'jogo_id' => 3,
                'quantidade' => 15,
                'valor' => 2.5,
                'maximo' => false
            ),
            array(
                'jogo_id' => 3,
                'quantidade' => 16,
                'valor' => 40,
                'maximo' => false
            ),
            array(
                'jogo_id' => 3,
                'quantidade' => 17,
                'valor' => 340,
                'maximo' => false
            ),
            array(
                'jogo_id' => 3,
                'quantidade' => 18,
                'valor' => 2040,
                'maximo' => false
            ),
            array(
                'jogo_id' => 3,
                'quantidade' => 19,
                'valor' => 9690,
                'maximo' => false
            ),
            array(
                'jogo_id' => 3,
                'quantidade' => 20,
                'valor' => 38760,
                'maximo' => true
            ),
        );

        DB::table('prices')->insert($toInsert);
    }
}
