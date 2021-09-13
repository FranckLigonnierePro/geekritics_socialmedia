<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([      // roleseeder
            'category' => 'Humour et Memes',
        ]);

        DB::table('categories')->insert([
            'category' => 'Leaks et Rumeurs',
        ]);
        
        DB::table('categories')->insert([
            'category' => 'Avis et Tests',
        ]);
        
        DB::table('categories')->insert([
            'category' => "C'etait mieux avant",
        ]);
    }
}
