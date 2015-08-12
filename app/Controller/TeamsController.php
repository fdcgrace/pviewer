<?php
App::uses('AppController', 'Controller');
/**
 * Projects Controller
 *
 * @property Project $Project
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class TeamsController extends AppController {

	public $uses = array('Team', 'Project', 'Pdetail');

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$team = $this->Team->find('all', array('conditions' => array('Team.del_flg' => 1)));
		$project = $this->Project->find('all', array('conditions' => array('Project.del_flg' => 1)));
		foreach ($team as $key => $leader) {
			$arr[$leader['Team']['team']] = array($leader['Team']['team']);
		}

		foreach ($project as $val) {
			foreach($arr as $key => $value) {
				if ($value[0] == $val['Team']['team']) {
					$arr[$key][] = $val;

				}
			}
		}
		$this->set('team', $arr);
	}

	public function edit() {

	}
	public function delete($id = null) {
		die();
		$this->Project->id = $id;
		if (!$this->Project->exists()) {
			throw new NotFoundException(__('Invalid Team'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Project->saveField('del_flg', 0)) {			
			$this->Pdetail->updateAll(
			    array('Pdetail.del_flg' => 0),
			    array('Pdetail.project_id' => $id)
			);
			$this->Session->setFlash(__('The Project has been deleted.'));
		} else {
			$this->Session->setFlash(__('The Project could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
