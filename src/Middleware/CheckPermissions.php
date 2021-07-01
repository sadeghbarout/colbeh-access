<?php

namespace Colbeh\Access\Middleware;

use Closure;
use Colbeh\Access\Config;
use Colbeh\Access\Exceptions\NotAllowedException;
use Colbeh\Access\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckPermissions
{

	protected $permissionRules;

	public function handle(Request $request, Closure $next)
	{


		list($targetController, $targetMethod) = $this->getTargetControllerAndMethod($request);

		if($targetController != null) {

			$requiredPermissions = $this->requiredPermissions($targetController, $targetMethod);


			if ($requiredPermissions != null) {

				$adminPermissions = $this->getAdminPermissions();

				$this->checkIfHasPermission($requiredPermissions, $adminPermissions);
			}

		}



		return $next($request);
	}



	private function getTargetControllerAndMethod($request){
		$route = $request->route();
		if($route==null)
			return [null, null];

		$target=$route->getActionName();

		if(strpos($target, "@") === false)


		$targetParts = explode("@",$target);

		$targetMethod = $targetParts[1];

		$targetController = $this->getControllerName($targetParts[0]);

		return [$targetController, $targetMethod];
	}


	private function getControllerName($controllerPath){
		$targetControllerParts = explode("\\",$controllerPath);
		$targetController = $targetControllerParts[sizeof($targetControllerParts)-1];

		return $targetController;
	}



	private function getAdminPermissions(){
		$admin = Auth::guard(Config::guard())->user();

		if ($admin == null)
			throw new NotAllowedException();

		return Helper::getAdminPermissions($admin);
	}


	private function checkIfHasPermission($requiredPermissions, $adminPermissions){

		$requiredPermissions[]='root';
		$hasPermission =  null !== $adminPermissions->whereIn('name', $requiredPermissions)->first();

		if (!$hasPermission)
			throw new NotAllowedException();
	}



	private function requiredPermissions($targetController, $targetMethod){






		foreach($this->permissionRules as $controller => $permission){

			$controller = $this->getControllerName($controller);

			if($controller == $targetController){

				if( !isset( $permission['except'] ))
					return $permission['permissions'];


				if(! in_array($targetMethod, $permission['except']) ){
					return $permission['permissions'];
				}else{
					return null;
				}
			}
		}

		return null;

	}



}
