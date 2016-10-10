<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DELETE DATA:
        // -------------
        DB::table('permissions')->delete();

        // INJECT DATA:
        // -------------
        // TEMPLATE: Permisssion::create(['name' => '']);
        Permission::create(['name' => 'blocked']);
        Permission::create(['name' => 'active']);
    }
}
