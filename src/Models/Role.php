<?php

namespace Colbeh\Access\Models;

use Colbeh\Access\Config;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model {

	use HasFactory;

	public $fillable=['name','desc'];
	public $timestamps = false;

	//-----------------------------------------------------------------------------------------------------------------------------
	//-----------------------------------------------------   relations   ---------------------------------------------------------
	//-----------------------------------------------------------------------------------------------------------------------------

	public function permissions() {
		return $this->belongsToMany(Permission::class);
	}

	public function admins() {
		return $this->belongsToMany(Config::model());
	}

}
