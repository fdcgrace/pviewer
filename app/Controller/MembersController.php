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

	public function add() {
		$this->autoRender = false;
		if ($this->request->is('post')) {
			$this->Member->create();
			if ($this->Member->save($this->request->data)) {
				$this->Session->setFlash(__('The Member has been saved.'));
			} else {
				$this->Session->setFlash(__('The Member could not be saved. Name already exist.'));
			}
			return $this->redirect(array('action' => 'index'));
		}

		$teams = $this->Member->Team->find('list', array(
			'fields' => array(
				'team'
				)
			)
		);
		$view = new View($this, false);
		return $view->element('addMember', array('teams' => $teams));
	}

	public function edit($id = null) {
		
		$this->autoRender = false;
		$content = array();
		if (!$this->Member->exists($id)) {
			throw new NotFoundException(__('Invalid Team'));
		}
		if ($this->request->is(array('post', 'put'))) {

			$this->Member->id = $id;
			$this->Member->set($this->request->data);
	        if($this->Member->save()){
	           $this->Session->setFlash(__('The Member has been saved.'));
	        }else{
	            $this->Session->setFlash(__('The Member could not be saved. Please, try again.'));
	        }   
	        return $this->redirect(array('action' => 'index'));
		} else {
			$options = array('conditions' => array('Member.' . $this->Member->primaryKey => $id));
			$this->request->data = $this->Member->find('first', $options);
		}

		$options = array('conditions' => array('Member.' . $this->Member->primaryKey => $id));
		$members = $this->Member->find('first', $options);
		$content['members'] = $members;

		$team = $this->Member->Team->find('list', array(
			'fields' => array(
				'team'
				)
			)
		);


		$content['team'] = $team;
	
		$view = new View($this, false);
    	return $view->element('editMember', array('content' => $content));
		
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