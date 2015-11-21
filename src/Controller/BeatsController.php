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

function getCustomMesh( $data, $name ) {
	if ( isset($data[$name."_mesh"]) ) {
		return ($data[$name."_mesh"]);
	} else {
		return ($name."_normal.json");
	}
}

function getCustomColor( $data, $name ) {
	if ( isset($data[$name."_color"]) ) {
		return ($data[$name."_color"]);
	} else {
		return ("#ffffff");
	}
}

class BeatsController extends AppController
{
	public function initialize() {
		parent::initialize();
		$this->loadComponent('Security');
	}

	public function beforeFilter(Event $event) {
		parent::beforeFilter($event);
		$this->Auth->allow(['add']);
		$this->Security->config('unlockedActions', ['add']);
	}

	public function index() {
		$beats = $this->Beats->find('all')->order(["id"=>"DESC"]);
		$this->set('beats', $beats);
	}

	public function add($id = null) {
		require_once (ROOT.'/vendor/SimpleImage.php');

		$colors = array(
			array("name" => "Black","hex" => "#222222"),
			array("name" => "White","hex" => "#aaaaaa"),
			array("name" => "White","hex" => "#ffffff"),
			array("name" => "Red","hex" => "#ff5555"),
			array("name" => "Red","hex" => "#ff55ff"),
			array("name" => "Black","hex" => "#5555ff"),
			array("name" => "Purple","hex" => "#8646aa"),
			array("name" => "Green","hex" => "#44f484"),
			array("name" => "Orange","hex" => "#ffaa44")
		);
		$parts = array(
			array(
				"name" => "Hoop",
				"simple" => "hoop",
				"models" => array(
					array(
						"name" => "Normal",
						"obj" => "hoop_normal.json"
					),
					array(
						"name" => "Cat version",
						"obj" => "hoop_cat.json"
					)
				),
				"colors" => $colors
			),
			array(
				"name" => "Ear Pieces",
				"simple" => "ear_pieces",
				"models" => array(),
				"colors" => $colors
			),
			array(
				"name" => "Ear Cushions",
				"simple" => "ear_cushions",
				"models" => array(),
				"colors" => $colors
			),
			array(
				"name" => "Metal parts",
				"simple" => "metal",
				"models" => array(),
				"colors" => $colors
			),
			array(
				"name" => "Foam Hoop",
				"simple" => "foam",
				"models" => array(),
				"colors" => $colors
			),
			array(
				"name" => "Beats Outline",
				"simple" => "beats_outline",
				"models" => array(),
				"colors" => $colors
			),
			array(
				"name" => "Beats Shape",
				"simple" => "beats_shape",
				"models" => array(),
				"colors" => $colors
			),
			array(
				"name" => "Beats B",
				"simple" => "beats_b",
				"models" => array(),
				"colors" => $colors
			),
			array(
				"name" => "Attachments",
				"simple" => "attachments",
				"models" => array(),
				"colors" => $colors
			)
		);
		$this->set('parts', $parts);

		// Set JSON array with custom settings
		$custom_settings = $this->Beats->find('all')->where(['Beats.id' => $id])->first();
		$jsonbeats_origin = array();
		if ($id == null) {
			foreach ($parts as $part) {
				array_push( $jsonbeats_origin, array("name"=>$part["simple"], "obj"=>getCustomMesh(null, $part["simple"]), "color"=>getCustomColor(null, $part["simple"])) );
			}
			$this->set('jsonbeats_origin', json_encode($jsonbeats_origin));
			$this->set('custom_name', "New Custom Beats");
		} else {
			$this->set('jsonbeats_origin', $custom_settings->json);
			$this->set('custom_name', $custom_settings->name);
			$this->set('jsonbeats_array', json_decode($custom_settings->json, true));
		}
		$this->set('beat_id', $id);

		// If saved
		$beat = $this->Beats->newEntity();
		if ( $this->request->is(['post', 'put']) ) {
			$d = $this->request->data;

			$jsonbeats = array();
			foreach ($parts as $part) {
				array_push( $jsonbeats, array("name"=>$part["simple"], "obj"=>getCustomMesh($d, $part["simple"]), "color"=>getCustomColor($d, $part["simple"])) );
			}
			$d["json"] = json_encode($jsonbeats);
			$d["user_id"] = $this->Auth->user('id');

			if ( !empty($d['image']) ) {
				$image_name = "beats".time().".png";

				$image = new SimpleImage($d['image']);
				$image->fit_to_width(600);
				$image->save(ROOT.'/webroot/img/beats/'.$image_name);
				$image->fit_to_width(200);
				$image->save(ROOT.'/webroot/img/beats/thumb/'.$image_name);

				$d['image'] = $image_name;
			}

			$this->Beats->patchEntity($beat, $d);

			if ($beat->errors()) {
				delete_file(ROOT.'/webroot/img/beats/'.$d["image"]);
				delete_file(ROOT.'/webroot/img/beats/thumb/'.$d["image"]);
				$this->Flash->warning(__('Please correct form fields'));
				$this->set('errors', $beat->errors());
			} else {
				if ($this->Beats->save($beat)) {

					$this->Flash->success(__('Your custom Beats has been saved succesfully :)'));
					return $this->redirect(['controller'=>'Users', 'action'=>'view', strtolower($this->Auth->user('username'))]);
				} else {
					$this->Flash->error(__('Sorry, an error has occured'));
				}
			}
		}
		$this->set('beat', $beat);

		// SEO
		$this->set('seo_title', "3D Beats Customizer");
		$this->set('seo_description', "Create and share your custom Beats !");
	}

	public function delete($id = null) {
		if (!$this->Auth->user()) {return $this->redirect(['controller'=>'Pages', 'action'=>'home']);} // IF NOT CONNECTED

		$beat = $this->Beats->get($id);
		if ($this->Auth->user('id') != $beat->user_id) {return $this->redirect(['controller'=>'Users', 'action'=>'view', strtolower($this->Auth->user('username'))]);}

		delete_file(ROOT.'/webroot/img/beats/'.$beat->image);
		delete_file(ROOT.'/webroot/img/beats/thumb/'.$beat->image);

		if ($this->Beats->delete($beat)) {
			$this->Flash->success(__('Your custom headphone set has been deleted'));
			return $this->redirect(['controller' => 'Users', 'action' => 'view', strtolower($this->Auth->user('username'))]);
		}
	}
}
