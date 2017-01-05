<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

/**
 * Class UserTableSeeder
 *
 * @category Database_Table_Seeds.
 * @package  SIJOT_Website
 * @author   Tim Joosten <Topairy@gmail.com>
 * @license  MIT License
 * @link     https://github.com/Scouts-Sint-Joris/SIJOT-2.x
 */
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
                'class' => 'skin-black'
            ], [
                'name' => 'Thema licht zwart',
                'class' => 'skin-black-light'
            ], [
                'name' => 'Thema blauw',
                'class' => 'skin-blue'
            ], [
                'name' => 'Theme licht blauw',
                'class' => 'skin-blue-light'
            ], [
                'name' => 'Thema Groen',
                'class' => 'skin-green'
            ], [
                'name' => 'Thema licht groen',
                'class' => 'skin-green-light'
            ], [
                'name' => 'Thema purper',
                'class' => 'skin-purple'
            ], [
                'name' => 'Thema licht purper',
                'class' => 'skin-purple-light'
            ], [
                'name' => 'Thema rood',
                'class' => 'skin-red'
            ], [
                'name' => 'Thema licht rood',
                'class' => 'skin-red-light'
            ], [
                'name' => 'Thema geel',
                'class' => 'skin-yellow'
            ], [
                'name' => 'Thema licht geel',
                'class' => 'skin-yellow-light'
            ],
        ];

        $table = DB::table('themes');
        $table->delete();
        $table->insert($data);
    }
}
