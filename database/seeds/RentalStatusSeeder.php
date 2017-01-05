<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class UserTableSeeder
 *
 * @category Database_Table_Seeds.
 * @package  SIJOT_Website
 * @author   Tim Joosten <Topairy@gmail.com>
 * @license  MIT License
 * @link     https://github.com/Scouts-Sint-Joris/SIJOT-2.x
 */
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
                'name'  => trans('rental.lease-option'),
                'class' => 'label label-warning',
            ], 
            [
                'name'  => trans('rental.lease-confirm'),
                'class' => 'label label-success', 
            ], 
            [
                'name'  => trans('rental.lease-new'),
                'class' => 'label label-danger',
            ],
        ];

        $table = DB::table('rental_statuses'); 
        $table->delete(); 
        $table->insert($data);
    }
}
