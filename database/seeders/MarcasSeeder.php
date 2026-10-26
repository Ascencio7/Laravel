<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class MarcasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = array(
            [
                'nombre' => 'Nike',
                'created_at' => Carbon::now()
            ],
            [
                'nombre' => 'Puma',
                'created_at' => Carbon::now()
            ],
            [
                'nombre' => 'Adida',
                'created_at' => Carbon::now()
            ],
        );

        DB::table('marcas')->insert($data);

    }
}