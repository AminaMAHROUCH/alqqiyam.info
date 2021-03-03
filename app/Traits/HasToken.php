<?php 

namespace App\Traits;

use Illuminate\Support\Facades\Crypt;

trait HasToken {

	public function getToken() 
	{
		$userAccess = [
			'model' => get_class($this),
			'id' => $this->id,
			'email' => $this->email,
			'password' => $this->password
		];

		return Crypt::encrypt($userAccess);
	}
}