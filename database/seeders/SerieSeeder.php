<?php

namespace Database\Seeders;

use App\Models\Serie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SerieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Serie::create(['nome' => 'Marvel']);

        Serie::create(['nome' => 'TMNT']);
    }
}
