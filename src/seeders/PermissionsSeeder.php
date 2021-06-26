<?php
namespace Database\Seeders;

use Colbeh\Access\Models\Permission;
use Colbeh\Access\Models\Role;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder {

	public function run() {

		// root permission has access to everything
		Permission::create(['name' => 'root','desc'=>'']);


		// ...............................
		// .. add your permissions here ..
		// ...............................






		// the root permission is accessing to SuperAdmin role and access this role to first admin.
		// You can remove these
		$role=Role::create(['name' => 'superAdmin','desc'=>'super admin']);
		$role->permissions()->attach(1);
	}
}
