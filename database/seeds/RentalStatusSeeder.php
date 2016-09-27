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
                'class' => 'alert alert-warning',
            ], 
            [
                'name'  => 'Bevestigd',
                'class' => 'alert alert-success', 
            ], 
            [
                'name'  => 'Nieuwe aanvraag', 
                'class' => 'alert alert-danger',
            ],
        ];

        $table = DB::table('rental_statuses'); 
        $table->delete(); 
        $table->insert($data);
    }
}
