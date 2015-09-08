<?php
App::uses('AppController', 'Controller');

class MembersController extends AppController {
	public $uses = array('Member', 'Team');

	public $components = array('Paginator', 'Session');

	public function beforeFilter() {
		parent::beforeFilter();
		$this->set('controllerID', 3);
	}

	public function index() {
		$this->paginate = array('limit' => 5);
		$this->set('members', $this->Paginator->paginate());
	}

	public function add($id = null) {
		// $this->autoRender = false;
		$teamID = $id;
		if($this->request->is('post')) {
			if($this->Member->save($this->request->data)) {	
				$this->Session->write('result', 'success');
				$this->Session->write('message', 'Member saved.');
			} else {
				$this->Session->write('result', 'warning');
				$this->Session->write('message', 'Could not save. Member already exists.');
			}
		return $this->redirect($this->referer());
		}		
	}

	public function deactivate($id = null){
		$this->Member->id = $id;
		$this->Member->saveField("del_flg", 0);
		$this->redirect($this->referer());
	}

	public function activate($id = null){
		$this->Member->id = $id;
		$this->Member->saveField("del_flg", 1);
		$this->redirect($this->referer());
	}
}

?>