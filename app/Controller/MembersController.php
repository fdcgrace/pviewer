<?php
App::uses('AppController', 'Controller');

class MembersController extends AppController {
	public $uses = array('Member');

	public function index() {
	}

	public function add($id = null) {
		// $this->autoRender = false;
		$teamID = $id;

		$this->set('t_id', $teamID);

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
}

?>