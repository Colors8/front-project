<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;
use Cake\ORM\TableRegistry;

use SimpleImage\SimpleImage;
use Cake\Network\Email\Email;
use Cake\Validation\Validator;
use Cake\Auth\DefaultPasswordHasher;

class UsersController extends AppController
{
	public function initialize() {
		parent::initialize();
		$this->loadComponent('Security');
	}

	public function beforeFilter(Event $event) {
		parent::beforeFilter($event);
		$this->Auth->allow(['register', 'login', 'activate']);
	}

	public function register() {
		if ($this->Auth->user()) {return $this->redirect(['controller'=>'Users', 'action'=>'view', $this->Auth->user('username')]);} // IF CONNECTED
		require_once (ROOT.'/vendor/SimpleImage.php');

		$user = $this->Users->newEntity();

		if ( $this->request->is(['post', 'put']) ) {
			$d = $this->request->data;

			$d['token'] = md5( (new DefaultPasswordHasher)->hash($d['password']) );

			if ( !empty($d['image']['name']) ) {
				if (preg_match('/[.](jpg)|(png)|(gif)$/', $d['image']['name'])) {
					$image_name = pathinfo($d['image']['name'], PATHINFO_FILENAME);
					$image_extension = substr($d['image']['name'], strrpos($d['image']['name'], '.')+1);
					$d['image']['name'] = ($image_name.time().'.'.$image_extension);

					move_uploaded_file($d['image']['tmp_name'], ROOT.'/webroot/img/users/'.$d['image']['name']);

					$image = new SimpleImage(ROOT.'/webroot/img/users/'.$d['image']['name']);
					$image->fit_to_width(600);
					$image->save(ROOT.'/webroot/img/users/'.$d['image']['name']);
					$image->fit_to_width(200);
					$image->save(ROOT.'/webroot/img/users/thumb/'.$d['image']['name']);
					$image->desaturate();
					$image->save(ROOT.'/webroot/img/users/grayscale/'.$d['image']['name']);

					$d['image'] = $d['image']['name'];

				} else {
					$this->Flash->warning(__('Authorized extensions are .jpg, .png or .gif'));
					return $this->redirect($this->referer());
				}
			} else {
				$this->Flash->warning(__('Please add a photo to your profil'));
				return $this->redirect($this->referer());
				unset($d['image']);
			}

			if ($d['password'] == $d['password_confirm']) {
				$this->Users->patchEntity($user, $d);

				if ($user->errors()) {
					delete_file(ROOT.'/webroot/img/users/'.$d["image"]);
					delete_file(ROOT.'/webroot/img/users/thumb/'.$d["image"]);
					delete_file(ROOT.'/webroot/img/users/grayscale/'.$d["image"]);
					$this->Flash->warning(__('Please correct form fields'));
					$this->set('errors', $user->errors());
				} else {
					if ($this->Users->save($user)) {

						$link = 'http://www.beatsid.com/activation/'.$user->id.'-'.$user->token;

						$email = new Email();
						$email->profile('default')
							->from('contact@beatsid.com')
							->to($d['email'])
							->subject('[ Beats ID ] Account validation')
							->emailFormat('html')
							->template('signup')
							->viewVars(['username' => $d['username'],'link' => $link])
							->helpers(['Html'])
							->send();

						$this->Flash->success(__('Your account has been created. Please don\'t forget to activate it before log in'));
						return $this->redirect(['controller'=>'Pages', 'action'=>'home']);
					} else {
						$this->Flash->error(__('Sorry, we can not create your account'));
					}
				}
			} else {
				$this->Flash->warning(__('Passwords do not match'));
			}
		}
		$this->set('user', $user);

		// SEO
		$this->set('seo_title', "Register");
		$this->set('seo_description', "Create a Beats ID account to save and share your creations !");
	}

	public function activate($token = null) {
		if ($this->Auth->user()) {return $this->redirect('/');} // IF CONNECTED

		$token = explode('-', $token);
		$user = $this->Users->find()->where(['id' => $token[0], 'token' => $token[1], 'active' => 0])->first();
		if ( !empty($user) ) {
			$user->active = 1;
			$this->Users->save($user);
			$this->Flash->success(__("Your account has been activated ! Now you are able to log in"));
			return $this->redirect(['controller'=>'Users', 'action'=>'login']);
		} else {
			$this->Flash->error(__("Your activation link is invalid"));
			return $this->redirect(['controller'=>'Pages', 'action'=>'home']);
		}
		die();
	}

	public function login() {
		if ($this->Auth->user()) {return $this->redirect(['controller'=>'Users', 'action'=>'view', $this->Auth->user('username')]);} // IF CONNECTED

		if ($this->request->is(['post', 'put'])) {
			$user = $this->Auth->identify();
			if ($user) {
				if ($user['active'] != 0) {
					$this->Auth->setUser($user);

					$this->Flash->info(__("Hello ".$this->Auth->user('username')." !"));
					return $this->redirect(['controller'=>'Users', 'action'=>'view', strtolower($this->Auth->user('username'))]);
				}
				$this->Flash->info(__("Please remember to activate your account before log in"));
			} else {
				$this->Flash->error(__('Invalid identification, please try again'));
			}
		}

		// SEO Page title
		$this->set('seo_title', "Login");
		$this->set('seo_description', "Log in to the Beats ID community");
	}

	public function logout() {
		if (!$this->Auth->user()) {return $this->redirect('/');} // NOT CONNECTED

		$this->Flash->info(__("You are now disconnected"));
		return $this->redirect($this->Auth->logout());
	}

	public function view($username = null) {
		if (!$this->Auth->user()) {return $this->redirect('/');} // NOT CONNECTED

		$user = $this->Users->find('all')->where(['Users.username' => $username])
			->contain([
				'Beats' => function ($q) {
					return $q->order(['Beats.created' => 'DESC']);
				}
			])->first();
		if (!$user) {
			return $this->redirect(['controller'=>'Users', 'action'=>'notFound']);
			die();
		}
		$this->set('user', $user);

		// SEO Page title
		$this->set('seo_title', "My account");
	}

	public function notfound() {
		// SEO Page title
		$this->set('seo_title', "Bad username");
	}

	public function delete($id = null) {
		if ($this->Auth->user('rank') != 4) {return $this->redirect(['controller'=>'Pages', 'action'=>'home']);} // IF ADMIN

		$user = $this->Users->get($id);

		delete_file(ROOT.'/webroot/img/users/'.$user->image);
		delete_file(ROOT.'/webroot/img/users/thumb/'.$user->image);
		delete_file(ROOT.'/webroot/img/users/grayscale/'.$user->image);

		if ($this->Users->delete($user)) {
			$this->Flash->success(__('Your account has been deleted'));
			return $this->redirect(['controller' => 'Pages', 'action' => 'home']);
		}
	}
}
