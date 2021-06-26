<?php
/**
 * Created by PhpStorm.
 * User: sadegh
 * Date: 20/06/2021
 * Time: 11:20 AM
 */

namespace Colbeh\Access;


use Illuminate\Database\Eloquent\Model;

class Config {

	public static function model():Model {
		$guard = self::guard();
		$provider = config("auth.guards.$guard.provider");
		$model = config("auth.providers.$provider.model");
		return new $model;
	}


	public static function guard(): string {
		$guard = config('access_colbeh.guard');
		if($guard==''){
			$guard = config('auth.defaults.guard');
		}
		return $guard;
	}



}