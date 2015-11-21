<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table {

	public function initialize(array $config) {
		$this->hasMany('Beats');
		$this->addBehavior('Timestamp');
	}

	public function validationDefault(Validator $validator) {
		$validator = new Validator();
		$validator
			->notEmpty('username', 'Please pick up a username')
			->add('username', 'alphanumeric', [
				'rule' => function ($username) {
					if (preg_match("/^[a-zA-Z0-9]+$/", $username) == 1) {
						return true;
					} else {
						return false;
					}
				},
				'message' => 'Authorized characters are A-Z, a-z et 0-9'
			])
			->add('username', [
				'unique' => ['rule' => 'validateUnique', 'provider' => 'table', 'message' => 'Sorry this username is already used']
			])
			->add('username', 'custom', [
				'rule' => function ($username) {
					if (strlen($username) >= 4 && strlen($username) <= 36) {
						return true;
					} else {
						return false;
					}
				},
				'message' => 'Your username must contain between 4 and 36 characters'
			])
			->notEmpty('email', 'You must give an email address')
			->add('email', [
				'unique' => ['rule' => 'validateUnique', 'provider' => 'table', 'message' => 'This email address is already used']
			])
			->add('email', 'validFormat', [
				'rule' => 'email',
				'message' => 'Your email address is not valid'
			])
			->notEmpty('password', 'You must enter a password')
			->add('password', 'custom', [
				'rule' => function ($password) {
					if (strlen($password) >= 4) {
						return true;
					} else {
						return false;
					}
				},
				'message' => 'Your password must contain more than 3 characters'
			])
			->notEmpty('password_new', 'You must enter a new password')
			->add('password_new', 'custom', [
				'rule' => function ($password) {
					if (strlen($password) >= 4) {
						return true;
					} else {
						return false;
					}
				},
				'message' => 'Your new password must contain more than 3 characters'
			]);
		return $validator;
	}

}

?>