<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class BeatsTable extends Table {

	public function initialize(array $config) {
		$this->belongsTo('Users');
		$this->addBehavior('Timestamp');
	}

	public function validationDefault(Validator $validator) {
		$validator = new Validator();
		$validator
			->notEmpty('name', 'Choose a badass name')

			->add('name', 'custom', [
				'rule' => function ($name) {
					if (strlen($name) >= 4 && strlen($name) <= 36) {
						return true;
					} else {
						return false;
					}
				},
				'message' => 'Name must contain between 2 and 36 characters'
			]);
		return $validator;
	}

}

?>