<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

	/**
	 * Initialization hook method.
	 *
	 * Use this method to add common initialization code like loading components.
	 *
	 * @return void
	 */
	public function initialize()
	{
		parent::initialize();
		$this->loadComponent('Flash');
		$this->loadComponent('Auth', [
			'loginRedirect' => ['controller' => 'Pages', 'action' => 'home'],
			'logoutRedirect' => ['controller' => 'Pages', 'action' => 'home'],
			'authenticate' => [
				'Form' => [
					'fields' => ['username' => 'email', 'password' => 'password']
				]
			]
		]);
	}
}

function address_maker($str) {
	$str = htmlentities($str, ENT_NOQUOTES, 'utf-8');

	$str = preg_replace('#&([A-za-z])(?:acute|grave|cedil|circ|orn|ring|slash|th|tilde|uml);#', '\1', $str);
	$str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str);
	$str = preg_replace('#&[^;]+;#', '', $str);
	$str = preg_replace('/[^A-Za-z0-9 !]/', ' ', $str);
	$str = preg_replace('/\s+/', '-', $str);

	$str = strip_tags($str);
	$str = html_entity_decode($str);
	$str = urldecode($str);
	$str = strtolower($str);
	$str = rtrim($str, '-');

	return $str;
}

function delete_file($pathToFile) {
	if (is_dir($pathToFile)) {
		return false;
	}
	if (file_exists($pathToFile)) {
		unlink($pathToFile);
	}
}
