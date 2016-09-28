<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RentalStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name'  => 'Optie', 
                'class' => 'label label-warning',
            ], 
            [
                'name'  => 'Bevestigd',
                'class' => 'label label-success', 
            ], 
            [
                'name'  => 'Nieuwe aanvraag', 
                'class' => 'label label-danger',
            ],
        ];

        $table = DB::table('rental_statuses'); 
        $table->delete(); 
        $table->insert($data);
    }
}
