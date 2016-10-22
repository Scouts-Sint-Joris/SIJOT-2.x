<?php

use Illuminate\Database\Seeder;

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
