<?php
namespace Database\Seeders;

use Colbeh\Access\Models\Permission;
use Colbeh\Access\Models\Role;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder {

	public function run() {

		// root permission has access to everything
		Permission::create(['name' => 'root','desc'=>'']);

		Permission::create(['name' => PERM_ADMIN_LIST_SHOW,'desc'=>'مشاهده ادمین ها','section'=>'admin']);
		Permission::create(['name' => PERM_ADMIN_STORE,'desc'=>'اضافه کردن ادمین','section'=>'admin']);
		Permission::create(['name' => PERM_ADMIN_UPDATE,'desc'=>'ویرایش ادمین','section'=>'admin']);
		Permission::create(['name' => PERM_ADMIN_DESTROY,'desc'=>'حذف ادمین','section'=>'admin']);
		Permission::create(['name' => PERM_ADMIN_ROLE,'desc'=>'اطلاق نقش به ادمین','section'=>'admin']);
		
		Permission::create(['name' => PERM_ROLE_LIST_SHOW,'desc'=>'مشاهده نقش مدیران','section'=>'role']);
		Permission::create(['name' => PERM_ROLE_STORE,'desc'=>'اضافه کردن نقش','section'=>'role']);
		Permission::create(['name' => PERM_ROLE_UPDATE,'desc'=>'ویرایش نقش','section'=>'role']);
		Permission::create(['name' => PERM_ROLE_DESTROY,'desc'=>'حذف نقش','section'=>'role']);
		Permission::create(['name' => PERM_ROLE_PERMISSION,'desc'=>'ویرایش دسترسی های نقش','section'=>'role']);

		// ...............................
		// .. add your permissions here ..
		// ...............................






		// the root permission is accessing to SuperAdmin role and access this role to first admin.
		// You can remove these
		$role=Role::create(['name' => 'superAdmin','desc'=>'super admin']);
		$role->permissions()->attach(1);
	}
}
