<?php

namespace App\Http\Middleware;

use App\Http\Controllers\CustomerController;
use Colbeh\Access\Middleware\CheckPermissions;

class CheckPermission extends CheckPermissions
{

/*
 * examples :

	 CustomerController::class =>[
		'permissions'=>['permissionName'],
		'except'=>['methodName'],
	],

 */




   protected $permissionRules = [

		CustomerController::class =>[
			'permissions'=>['p2'],
			'except'=>['methodName'],
		],

   ];


}
