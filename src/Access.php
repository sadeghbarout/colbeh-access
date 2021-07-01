<?php

namespace Colbeh\Access;

use Colbeh\Access\Exceptions\PermissionException;
use Colbeh\Access\Exceptions\RoleNotFoundException;
use Colbeh\Access\Models\Permission;
use Colbeh\Access\Models\Role;
use Illuminate\Support\Facades\Auth;

class Access {

	public static function getAdmin($id) {
		$admin = Config::model()::find($id);
		if ($admin == null)
			throw new RoleNotFoundException();

		return $admin;
	}


	public static function getRole($id) {
		$role = Role::find($id);
		if ($role == null)
			throw new RoleNotFoundException();

		return $role;
	}


	public static function roleStore($name, $desc, $permissionIds) {
		$role = Role::create(['name' => $name, 'desc' => $desc]);
		$role->permissions()->sync($permissionIds);

		return $role;
	}


	public static function roleUpdate($roleId, $name, $desc, $permissionIds = null) {
		$role = self::getRole($roleId);

		$role->update(['name' => $name, 'desc' => $desc]);

		if ($permissionIds)
			$role->permissions()->sync($permissionIds);

		return $role;
	}


	public static function roleToggle($adminId, $permissionId) {
		$admin = self::getAdmin($adminId);

		$admin->roles()->toggle($permissionId);

		return $admin;
	}

	public static function roleAttach($adminId, $permissionId) {
		$admin = self::getAdmin($adminId);

		$admin->roles()->attach($permissionId);

		return $admin;
	}


	public static function roleDetach($adminId, $permissionId) {
		$admin = self::getAdmin($adminId);

		$admin->roles()->detach($permissionId);

		return $admin;
	}


	public static function rolesList() {
		return Role::get();
	}


	public static function permissionToggle($roleId, $permissionId) {
		$role = self::getRole($roleId);

		$role->permissions()->toggle($permissionId);

		return $role;
	}

	public static function permissionAttach($roleId, $permissionId) {
		$role = self::getRole($roleId);

		$role->permissions()->attach($permissionId);

		return $role;
	}


	public static function permissionDetach($roleId, $permissionId) {
		$role = self::getRole($roleId);

		$role->permissions()->detach($permissionId);

		return $role;
	}


	public static function permissionsList($roleId = null) {
		if ($roleId == null) {
			return Permission::get();
		} else {
			return Role::find($roleId)->permissions;

		}
	}


	public static function hasAccess($permissionName) {
		$user = Auth::guard(Config::guard())->user();
		return \Illuminate\Support\Facades\Gate::forUser($user)->allows('permission', [$permissionName]);
	}


	public static function checkAccess($permissionName) {
		if(!self::hasAccess($permissionName)){
			throw new PermissionException();
		}
	}

}



