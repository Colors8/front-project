<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;
use Cake\ORM\TableRegistry;

class PagesController extends AppController
{
	public function initialize() {
		parent::initialize();
		$this->loadComponent('Security');
	}

	public function beforeFilter(Event $event) {
		parent::beforeFilter($event);
		$this->Auth->allow(['prehome', 'home', 'custom']);
	}

	public function prehome() {
		$this->viewBuilder()->layout('empty');
		// SEO
		$this->set('seo_title', "Studio wireless");
		$this->set('seo_description', "Discover and personalize the brand new beats studio wireless");
	}

	public function home() {
		$this->viewBuilder()->layout('empty');
		// SEO
		$this->set('seo_title', "Home");
	}

	public function about() {
		// SEO
		$this->set('seo_title', "About us");
	}

	public function spec() {
		$this->viewBuilder()->layout('default2');
		// SEO
		$this->set('seo_title', "Beats Studio Wireless Specs");
	}

	public function video() {
		// SEO
		$this->set('seo_title', "Sound Experience");
	}
}
