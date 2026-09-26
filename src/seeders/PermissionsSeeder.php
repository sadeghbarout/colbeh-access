<?php

namespace Database\Seeders;

use Colbeh\Access\Models\Permission;
use Colbeh\Access\Models\Role;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder {

	public function run() {
		// root permission has access to everything
		Permission::updateOrCreate(
			['name' => 'root'],
			['desc' => 'مدیر ارشد', 'order' => 0]
		);

		$permissions = [
			['name' => PERM_ADMIN_LIST_SHOW, 'desc' => 'مشاهده ادمین ها', 'section' => 'مدیران'],
			['name' => PERM_ADMIN_STORE, 'desc' => 'اضافه کردن ادمین', 'section' => 'مدیران'],
			['name' => PERM_ADMIN_UPDATE, 'desc' => 'ویرایش ادمین', 'section' => 'مدیران'],
			['name' => PERM_ADMIN_DESTROY, 'desc' => 'حذف ادمین', 'section' => 'مدیران'],
			['name' => PERM_ADMIN_ROLE, 'desc' => 'اطلاق نقش به ادمین', 'section' => 'مدیران'],

			['name' => PERM_ROLE_LIST_SHOW, 'desc' => 'مشاهده نقش مدیران', 'section' => 'نقش ها'],
			['name' => PERM_ROLE_STORE, 'desc' => 'اضافه کردن نقش', 'section' => 'نقش ها'],
			['name' => PERM_ROLE_UPDATE, 'desc' => 'ویرایش نقش', 'section' => 'نقش ها'],
			['name' => PERM_ROLE_DESTROY, 'desc' => 'حذف نقش', 'section' => 'نقش ها'],
			['name' => PERM_ROLE_PERMISSION, 'desc' => 'ویرایش دسترسی های نقش', 'section' => 'نقش ها'],

			['name' => PERM_LOGS_LIST_SHOW, 'desc' => 'مشاهده لاگ ها', 'section' => 'لاگ ها'],
			['name' => PERM_LOGS_EXCEL, 'desc' => 'خروجی اکسل', 'section' => 'لاگ ها'],
			['name' => PERM_LOGS_LIST_UPDATE, 'desc' => 'مشاهده لاگ های ویرایش', 'section' => 'لاگ ها'],

			// ...............................
			// .. add your permissions here ..
			// ...............................
		];

		foreach ($permissions as $index => $permission) {
			Permission::updateOrCreate(
				['name' => $permission['name']],
				[
					'desc' => $permission['desc'],
					'section' => $permission['section'],
					'order' => $index + 1,
				]
			);
		}

		// the root permission is accessing to SuperAdmin role and access this role to first admin.
		// You can remove these
		$role = Role::updateOrCreate(
			['name' => 'superAdmin'],
			['desc' => 'super admin']
		);

		$rootPermission = Permission::where('name', 'root')->first();
		$role->permissions()->syncWithoutDetaching([$rootPermission->id]);
	}
}
