<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data['name']       = 'Administrator';
		$data['email']      = 'admin@st-joris-turnhout.be';
		$data['password']   = bcrypt('root1995');

		$table = DB::table('users');
		$table->delete();

        $create = User::create($data);
        $user   = User::find($create->id);

        $user->givePermissionTo('active');
    }
}
