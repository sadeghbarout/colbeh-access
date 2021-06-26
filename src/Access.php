<?php

namespace Colbeh\Access;

use Colbeh\Access\Exceptions\RoleNotFoundException;
use Colbeh\Access\Models\Permission;
use Colbeh\Access\Models\Role;
use Illuminate\Auth\Access\Gate;
use Illuminate\Support\Facades\Auth;

class Access {

	public static function roleStore($name,$desc,$permissionIds) {
		$role = Role::create(['name'=>$name,'desc'=>$desc]);
		$role->permissions()->sync($permissionIds);

		return $role;
	}


	public static function roleUpdate($id,$name,$desc,$permissionIds=null) {
		$role= Role::find($id);
		if($role==null)
			throw new RoleNotFoundException();

		$role->update(['name'=>$name,'desc'=>$desc]);

		if($permissionIds)
			$role->permissions()->sync($permissionIds);

		return $role;
	}

	public static function permissionToggle($id,$permissionId) {
		$role= Role::find($id);
		if($role==null)
			throw new RoleNotFoundException();

		$role->permissions()->toggle($permissionId);

		return $role;
	}

	public static function permissionAttach($id,$permissionId) {
		$role= Role::find($id);
		if($role==null)
			throw new RoleNotFoundException();

		$role->permissions()->attach($permissionId);

		return $role;
	}


	public static function permissionDetach($id,$permissionId) {
		$role= Role::find($id);
		if($role==null)
			throw new RoleNotFoundException();

		$role->permissions()->detach($permissionId);

		return $role;
	}



	public static function roleDetach($id,$permissionId) {
		$role= Role::find($id);
		if($role==null)
			throw new RoleNotFoundException();

		$role->permissions()->detach($permissionId);

		return $role;
	}


	public static function rolesList() {
		return Role::get();
	}


	public static function permissionsList($roleId=null) {
		if($roleId==null){
			return Permission::get();
		}else{
			return Role::find($roleId)->permissions;

		}
	}


	public static function hasAccess($permissionName) {
		$user=Auth::guard(Config::guard())->user();
		return \Illuminate\Support\Facades\Gate::forUser($user)->allows('permission',$permissionName);
	}


}



