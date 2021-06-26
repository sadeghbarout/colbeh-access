<?php

//run tests with :  php vendor/bin/phpunit packages/colbeh/access

class AccessTest extends \Tests\TestCase
{
	public function testAddRole()
	{
		$role=\Colbeh\Access\Access::roleStore('new Role','Role desc',[1,2]);
		$this->assertTrue($role instanceof \Colbeh\Access\Models\Role);
	}

	public function testRoleUpdate()
	{
		$role=\Colbeh\Access\Access::roleUpdate(10,'updated Role','updated desc',[1,2]);
		$this->assertTrue($role instanceof \Colbeh\Access\Models\Role);
	}

	public function testRoleToggle()
	{
		$role=\Colbeh\Access\Access::permissionToggle(6,1);
		$this->assertTrue($role instanceof \Colbeh\Access\Models\Role);
	}

	public function testRoleAttach()
	{
		$role=\Colbeh\Access\Access::permissionAttach(5,1);
		$this->assertTrue($role instanceof \Colbeh\Access\Models\Role);
	}

	public function testRoleDetach()
	{
		$role=\Colbeh\Access\Access::permissionDetach(10,1);
		$this->assertTrue($role instanceof \Colbeh\Access\Models\Role);
	}

	public function testRolesList()
	{
		$roles=\Colbeh\Access\Access::rolesList();
		$this->assertTrue($roles->count()>0);
	}

	public function testPermissionsList()
	{
		$permissions=\Colbeh\Access\Access::permissionsList(10);
		$this->assertTrue($permissions->count()>0);
	}

	public function testHasAccess()
	{
		\Illuminate\Support\Facades\Auth::guard(\Colbeh\Access\Config::guard())->loginUsingId(1);
		$user=\Illuminate\Support\Facades\Auth::guard(\Colbeh\Access\Config::guard())->user();
		$user->roles()->attach(1);

		$hasPermission=\Colbeh\Access\Access::hasAccess('root');
		$this->assertTrue($hasPermission);
	}

}