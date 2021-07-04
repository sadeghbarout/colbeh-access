<?php

namespace Colbeh\Access;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ServiceProvider extends \Illuminate\Support\ServiceProvider {
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->publish();

		$this->defineGates();
	}


	private function publish(){
		$this->publishes([
			__DIR__.'/access_colbeh.php' => config_path('access_colbeh.php'),
		], 'config');


		$this->publishes([
			__DIR__.'/Middleware/CheckPermission.php' => app_path('Http/Middleware/CheckPermission.php'),
			__DIR__.'/seeders/PermissionsSeeder.php' => database_path('seeders/PermissionsSeeder.php'),
			__DIR__.'/migrations/2021_01_01_000000_create_admin_role_table.php' => database_path('migrations/2021_01_01_000000_create_admin_role_table.php'),
			__DIR__.'/migrations/2021_01_01_000000_create_permission_role_table.php' => database_path('migrations/2021_01_01_000000_create_permission_role_table.php'),
			__DIR__.'/migrations/2021_01_01_000000_create_permissions_table.php' => database_path('migrations/2021_01_01_000000_create_permissions_table.php'),
			__DIR__.'/migrations/2021_01_01_000000_create_roles_table.php' => database_path('migrations/2021_01_01_000000_create_roles_table.php'),
		], 'database');
	}


	private function defineGates(){
		Gate::define('permission',function($user, $permissions){


			$adminPermissions = Helper::getAdminPermissions($user);


			if (!is_array($permissions)) {
				$permissions = array($permissions);
			}
			$permissions[]='root';

			return null !== $adminPermissions->whereIn('name', $permissions)->first();
		});
	}


}