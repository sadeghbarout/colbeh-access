<?php
namespace Colbeh\Access\Exceptions;


class UserNotExistsException extends \Exception {
	public function __construct() {
		parent::__construct();
	}

	public function render() {
		return response()->json([
			'result' => 'error_message',
			'message' => 'شما به این بخش دسترسی ندارید!'
		])->setStatusCode(401);
	}
}