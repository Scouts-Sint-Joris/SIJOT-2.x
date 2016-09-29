<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ThemeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            // TEMPLATE:
            // ['name' => '', 'class' => ''],
            [
                'name' => 'Thema zwart', 
                'class' => ''
            ], [
                'name' => 'Thema licht zwart', 
                'class' => ''
            ], [
                'name' => 'Thema blauw', 
                'class' => ''
            ], [
                'name' => 'Theme licht blauw', 
                'class' => ''
            ], [
                'name' => 'Thema Groen', 
                'class' => ''
            ], [
                'name' => 'Thema licht groen', 
                'class' => ''
            ], [
                'name' => 'Thema purper',
                'class' => ''
            ], [   
                'name' => 'Thema licht purper', 
                'class' => ''
            ], [   
                'name' => 'Thema rood', 
                'class' => ''
            ], [   
                'name' => 'Thema licht rood', 
                'class' => ''
            ], [
                'name' => 'Thema geel', 
                'class' => ''
            ], [
                'name' => 'Thema licht geel', 
                'class' => ''
            ],
        ];

        $table = DB::table('themes');
        $table->delete();
        $table->insert($data);
    }
}
