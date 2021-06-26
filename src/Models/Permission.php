<?php

namespace Colbeh\Access\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model {

	use HasFactory;

	//-----------------------------------------------------------------------------------------------------------------------------
	//-----------------------------------------------------   relations   ---------------------------------------------------------
	//-----------------------------------------------------------------------------------------------------------------------------

	public function roles() {
		return $this->belongsToMany(Role::class);
	}

}
