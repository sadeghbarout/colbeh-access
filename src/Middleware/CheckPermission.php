<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Controller;
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

	   Controller::class =>[
			'permissions'=>['permissionName'],
			'except'=>['methodName'],
		],

   ];


}
