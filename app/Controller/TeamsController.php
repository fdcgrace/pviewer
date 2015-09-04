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

	public $uses = array('Team', 'Project', 'Pdetail', 'Member');

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
		//var_dump($arr);
		//$this->set('team', $arr);
		//var_dump($this->Paginator->paginate());
		$pdetails = $this->Project->find('all', array( 'recursive' => 1, 
					   'contain' => 
					   		array( 'Pdetail' => 
					   					array( 'conditions' => array('Pdetail.team_id !=' => 0)
					   					)
					   		)
				)
		);
		/*$unassigned = $this->Project->find('all', 
				array( 'recursive' => 1, 
					   'contain' => 
					   		array( 'Pdetail' => 
					   					array( 'conditions' => array('Pdetail.member_id' => null, 'Pdetail.status' => 0)
					   					)
					   		)
				)
		);*/

		$team = $this->Team->find('all');
		// $members = $this->Member->find('all');
		$this->set('team', $team);
		// $this->set('members', $members);
		$this->set('pdetails', $pdetails);
	}

	public function add() {
		if($this->request->is('post')) {
			if($this->Team->save($this->request->data)) {	
				$this->Session->write('result', 'success');
				$this->Session->write('message', 'Team name saved.');
			} else {
				$this->Session->write('result', 'warning');
				$this->Session->write('message', 'Could not save. Team name already exists.');
			}
		}		
		return $this->redirect(array('action' => 'index'));
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

	public function update() {
		$this->autoRender = false;
		if($this->request->is('ajax')) {
			$data = $this->request->data;
			$filename = "sql.txt";
			// var_dump($data);
			if(isset($this->request->data['member_id'])) {
				$line = "UPDATE Pdetails SET team_id=".$data['team_id'].
						", member=".$data['member_id'].
						", status=".$data['status'].
						" WHERE id=".$data['issue_id'].
						";\n";
			} else {
				$line = "UPDATE Pdetails SET team_id=".$data['team_id'].
						", member=0".
						", status=0".
						" WHERE id=".$data['issue_id'].
						";\n";
			}
			fopen(WWW_ROOT.$filename, "a");
			file_put_contents($filename, $line, FILE_APPEND);
		}
	}

	public function save() {
		$this->autoRender = false;
		$query = array();
		$filename = "sql.txt";
		
		$file = fopen(WWW_ROOT.$filename, "c+");
		$query = explode("\n", fread($file, filesize($filename)));
		$length = count($query);
		unset($query[$length-1]);
		
		foreach ($query as $sql) {
			$this->Pdetail->query($sql);
		}
		
		file_put_contents($filename, "");
		return $this->redirect(array('action' => 'index'));
	}

	public function team() {
		$this->autoRender =  false;
		if ($this->request->is("ajax")) {
			
			$data = $this->request->data;
			$this->Session->write('team', $data['team_id']);			
			$content = array();

			if (isset($data['team_id'])) { 
				$content['team'] = $this->Team->find('first', array(
						'conditions' => array('Team.id' => $data['team_id'])
					)
				);
				$content['members'] = $this->Member->find('all', array(
						'conditions' => array('Member.team_id' => $data['team_id'])
					)
				);
			}

			if(isset($data['project_id'])) {
				$content['pdetails'] = $this->Project->find('all', array( 
						'recursive' => 1, 
						'conditions' => array('Project.id' => $data['project_id']),
				   		'contain' => array( 
				   			'Pdetail' => array( 
				   					'conditions' => array(
										'Pdetail.member !=' => 0,
				   						'Pdetail.team_id !=' => 0)
				   					)
				   			)
					)
				);
			}
			$view = new View($this, false);
			return $view->element('team', array('content' => $content));
		}
	}

	public function project() {
		$this->autoRender = false;
		if ($this->request->is("ajax")) {

			$data= $this->request->data;
			$this->Session->write('project', $data['project_id']);			
			$content = array();

			if(isset($data['project_id'])) {
				$content['project'] = $this->Project->find('first', array(
						'recursive' => 0,
						'conditions' => array('Project.id' =>  $data['project_id']),
						'fields' => array('Project.id, Project.p_name, Project.team_id')
					)
				);


				$content['unassigned'] = $this->Pdetail->find('all', array( 
						'recursive' => -1, 
						'conditions' => array(
							'Pdetail.project_id' => $data['project_id'],
							'Pdetail.member' => 0, 
							'Pdetail.status' => 0
						)
					)
				);
				$view = new View($this, false);
				return $view->element('project', array('content' => $content));
			}
		}

	}

	public function view() {
		$this->paginate = array('limit' => 5);
		$this->set('teams', $this->Paginator->paginate());
	}

	public function deactivate($id = null){
		$this->Team->id = $id;
		$this->Team->saveField("del_flg", 0);
		$this->redirect($this->referer());
	}

	public function activate($id = null){
		$this->Team->id = $id;
		$this->Team->saveField("del_flg", 1);
		$this->redirect($this->referer());
	}
}
