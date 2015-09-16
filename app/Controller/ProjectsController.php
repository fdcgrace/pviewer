<?php
App::uses('AppController', 'Controller');
/**
 * Projects Controller
 *
 * @property Project $Project
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ProjectsController extends AppController {

	public $uses = array('Project', 'Pdetail', 'Team','Member');

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

	public function beforeFilter() {
		parent::beforeFilter();
		$this->set('controllerID', 1);
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Project->recursive = 0;
		$this->paginate = array(
	            'limit' => 5, 
	            'order' => 'modified DESC', 
	            'joins' => array(
						array(
							'table' => 'Pdetails',
							'alias' => 'Pdetail',
							'type'	=> 'LEFT',
							'conditions' => array('Pdetail.project_id = Project.id AND Pdetail.status <> 6 AND Pdetail.status <> 5')
						),
						array(
							'table' => 'Teams',
							'alias' => 'Leader',
							'type'	=> 'LEFT',
							'conditions' => array('Project.team_id = Leader.id')
						),

					),
	            'group' => array('Pdetail.project_id'),
	            'fields' => array('count(Pdetail.project_id) as total_num_task', '*', 'Leader.team'),
	            'conditions' => array('Project.del_flg' => 1)
        	);
		
		$pagination = $this->paginate('Project');
		$this->set('projects', $pagination);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Project->exists($id)) {
			throw new NotFoundException(__('Invalid project'));
		}
		$options = array('conditions' => array('Project.' . $this->Project->primaryKey => $id));
		$this->set('project', $this->Project->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->autoRender = false;
		if ($this->request->is('post')) {
			$this->Project->create();
			if ($this->Project->save($this->request->data)) {
				$this->Session->setFlash(__('The project has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The project could not be saved. Please, try again.'));
			}
		}

		$teams = $this->Project->Team->find('list', array(
			'fields' => array(
				'team'
				)
			)
		);
		$view = new View($this, false);
		return $view->element('newProj', array('teams' => $teams));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->autoRender = false;
		if (!$this->Project->exists($id)) {
			throw new NotFoundException(__('Invalid project'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Project->save($this->request->data)) {
				$this->Session->setFlash(__('The project has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The project could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Project.' . $this->Project->primaryKey => $id));
			$this->request->data = $this->Project->find('first', $options);
		}

		$teams = $this->Project->Team->find('list', array(
			'fields' => array(
				'team'
				)
			)
		);
		$data = $this->Project->find('first', array(
			'conditions' => array('Project.id' => $id),
			'fields' => 'team_id',
			'recursive' => 0
			)
		);
		$view = new View($this, false);
		return $view->element('editProj', array('teams' => $teams, 'data' => $data));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Project->id = $id;
		if (!$this->Project->exists()) {
			throw new NotFoundException(__('Invalid project'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Project->delete()) {
			$this->Session->setFlash(__('The project has been deleted.'));
		} else {
			$this->Session->setFlash(__('The project could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function deactivate($id = null){
		$this->Project->id = $id;
		if (!$this->Project->exists()) {
			throw new NotFoundException(__('Invalid project'));
		}

		if ($this->Project->saveField("del_flg", 0)) {
			$this->Session->setFlash(__('The project has been deactivated.'));
		} else {
			$this->Session->setFlash(__('The project could not be deactivated. Please, try again.'));
		}

		$this->redirect($this->referer());
	}

	public function activate($id = null){
		$this->Project->id = $id;
		if (!$this->Project->exists()) {
			throw new NotFoundException(__('Invalid project'));
		}
		
		if ($this->Project->saveField("del_flg", 1)) {
			$this->Session->setFlash(__('The project has been activated.'));
		} else {
			$this->Session->setFlash(__('The project could not be activated. Please, try again.'));
		}

		$this->redirect($this->referer());
	}

	public function viewArchive()
	{
			$project = $this->Project->find('all',array('conditions' =>
				array('Project.del_flg' => 0)
				));

			$view = new View($this, false);
		    $blah =  $view->element('testing');

			$this->set('deletedProject', $project);
			$this->set('blah', $blah);
	}
	public function chuchu()
	{
		$this->autoRender = false;
 
		/* Set up new view that won't enter the ClassRegistry */
		$view = new View($this, false);
		$view->set('text', 'Hello World');
		$view->viewPath = 'elements';
		 
		$view_output = $view->render('view_archive');
		$this->set('churva', $view_output);
		$this->render('view_archive');


	}
	public function getIssues(){
		$this->autoRender = false;
		$view = new View($this, false);

		$issues = $this->Pdetail->find('all',
										array('conditions' => array('Pdetail.del_flg' => 0)));
		//$this->set('issueArray',$issues);
		$blah =  $view->element('getIssues', array('issueArray' => $issues));

		return $blah;
	}
	public function getLeaders()
	{
			$this->autoRender = false;
		$view = new View($this, false);

		//$issues = $this->Team->find('all',array('conditions' => array('Member.del_flg' => 0)));




		$storeDivisions = $this->Team->find('all',
                array('joins' => array(
                                       array('table' => 'projects',
                                             'alias' => 'Project',
                                             'type' => 'left',
                                             'conditions'=> array('Team.id = Project.team_id')
                                        )
                                 ),
                       'conditions'=>array('Team.del_flg'=> 0)
                ));



		
		$leaders =  $view->element('getLeaders', array('issueArray' => $storeDivisions));

		return $leaders;
	}
}
