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
            // TEMPLATE: 
            // ---------------
            // [
            //    'selector' => '',
            //    'title'     => '',
            // ],  

            [
                'selector' => 'kapoenen',
                'heading'  => 'De Kapoenen'
            ], [
                'selector' => 'welpen',
                'heading'  => 'De Welpen'
            ], [   
                'selector' => 'jonggivers',
                'heading'  => 'De Jong-Givers'
            ], [
                'selector' => 'givers',
                'title'    => 'De Givers'
            ], [
                'selector' => 'jins',
                'heading'  => 'De Jins'
            ], [
                'selector' => 'leiding',
                'heading'  => 'De Leiding'
            ],
        ];
        
        $table = DB::table('groups'); 
        $table->delete(); 
        $table->insert($data);
    }
}
