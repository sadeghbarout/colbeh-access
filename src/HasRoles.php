<?php
/**
 * Created by PhpStorm.
 * User: sadegh
 * Date: 26/06/2021
 * Time: 03:44 PM
 */

namespace Colbeh\Access;


use Colbeh\Access\Models\Role;

trait HasRoles {

	public function roles(){
		return $this->belongsToMany(Role::class);
	}
}