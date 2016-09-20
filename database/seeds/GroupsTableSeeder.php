<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            // ['selector' => ''],  
            ['selector' => 'kapoenen'],
            ['selector' => 'welpen'],
            ['selector' => 'jonggivers'],
            ['selector' => 'givers'],
            ['selector' => 'jins'],
            ['selector' => 'leiding']
        ];
        
        $table = DB::table('groups'); 
        $table->delete(); 
        $table->insert($data);
    }
}
