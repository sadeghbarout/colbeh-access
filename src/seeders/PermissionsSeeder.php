<?php
namespace Database\Seeders;

use Colbeh\Access\Models\Permission;
use Colbeh\Access\Models\Role;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {

		Permission::create(['name' => 'root','desc'=>'']); // root permission has access to everything
		$role=Role::create(['name' => 'superAdmin','desc'=>'super admin']);
		$role->permissions()->attach(1);
	}
}
