<?php

namespace App\Http\Middleware;

use App\Http\Controllers\App\LogController;
use App\Http\Controllers\App\RoleController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\User\AdminController;
use Colbeh\Access\Middleware\CheckPermissions;

class CheckPermission extends CheckPermissions
{

	/*
	 * examples :

		 CustomerController::class =>[
			'permissions'=>['permissionName'], // admin should has one of these permissions
			'except'=>['methodName'], // these methods not check
		],

	 */




	protected $permissionRules = [

		Controller::class => [
			'permissions' => ['permissionName'],
			'except' => ['methodName'],
		],

		AdminController::class =>[
			'permMethods'=>[
				PERM_ADMIN_LIST_SHOW=> ['index','show'],
				PERM_ADMIN_STORE=> ['store'],
				PERM_ADMIN_UPDATE=> ['show','update', 'setNewPassword'],
				PERM_ADMIN_DESTROY=> ['destroy'],
				PERM_ADMIN_ROLE=> ['roleToggle'],
			],
		],

		RoleController::class => [
			'permMethods' => [
				PERM_ROLE_LIST_SHOW => ['index', 'show'],
				PERM_ROLE_STORE => ['store'],
				PERM_ROLE_UPDATE => ['update', 'show'],
				PERM_ROLE_DESTROY => ['destroy'],
				PERM_ROLE_PERMISSION => ['permissionToggle'],
			],
		],


		LogController::class => [
			'permMethods' => [
				PERM_LOGS_LIST_SHOW => ['index', 'show'],
				PERM_LOGS_LIST_UPDATE => ['index', 'show'],
			],
		],

	];


}
