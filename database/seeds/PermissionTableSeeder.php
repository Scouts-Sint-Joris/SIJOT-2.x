<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
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
        // TEMPLATE: Permission::create(['name' => '']);
        Permission::create(['name' => 'blocked']);
        Permission::create(['name' => 'active']);
        Permission::create(['name' => 'admin']);
    }
}
