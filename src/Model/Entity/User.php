<?php

namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

class User extends Entity
{
	protected $_accessible = ['*' => true];

	protected function _setPassword($password)
	{
		//return md5($password);
		return (new DefaultPasswordHasher)->hash($password);
	}

}