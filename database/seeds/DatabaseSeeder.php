<?php

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
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(GroupsTableSeeder::class);
        $this->call(RentalStatusSeeder::class);
        $this->call(ThemeTableSeeder::class);
        $this->call(NewsTableSeeder::class);
    }
}
