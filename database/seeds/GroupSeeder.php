<?php

use App\Models\Selection;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Selection::create([
            'code_group_question' => 'SKD',
            'name_group_question' => 'Seleksi Kompetensi Dasar'
        ]);

        Selection::create([
            'code_group_question' => 'SKB',
            'name_group_question' => 'Seleksi Kompetensi Bidang'
        ]);
    }
}
