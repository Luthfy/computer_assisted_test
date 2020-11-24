<?php

use App\Models\Test;
use Illuminate\Database\Seeder;

class TypeOfTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Test::create([
            'code_sub_group_question' => 'TWK',
            'name_sub_group_question' => 'Tes Wawasan Kebangsaan'
        ]);

        Test::create([
            'code_sub_group_question' => 'TIU',
            'name_sub_group_question' => 'Tes Intelegensi Umum'
        ]);

        Test::create([
            'code_sub_group_question' => 'TKP',
            'name_sub_group_question' => 'Tes Karakteristik Pribadi'
        ]);
    }
}
