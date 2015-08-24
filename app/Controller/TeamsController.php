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

	public $uses = array('Team', 'Project');

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

		/*$team = $this->Team->find('all');
		$project = $this->Project->find('all');
		foreach ($team as $key => $leader) {
			$arr[$leader['Team']['team']] = array($leader['Team']['team']);
			
		}


		foreach ($project as $val) {
			foreach($arr as $key => $value) {
				//var_dump($value);
				if ($value[0] == $val['Team']['team']) {
					$arr[$key][] = $val;

				}
			}
		}*/
		//var_dump($arr);
		//$this->set('team', $arr);
		//var_dump($this->Paginator->paginate());

		$this->paginate = array(
	            'limit' => 5, 
	            'order' => 'team ASC', 
	            'joins' => array(
	            		array(
							'table' => 'Projects',
							'alias' => 'Project',
							'type'	=> 'LEFT',
							'conditions' => array('Team.id = Project.team_id')
						),
						array(
							'table' => 'Pdetails',
							'alias' => 'Pdetail',
							'type'	=> 'LEFT',
							'conditions' => array('Project.id = Pdetail.project_id AND Pdetail.status <> 6 AND Pdetail.status <> 5')
						),
					),
	            'group' => array('Team.team'),
	            'conditions' => array('Team.id >= 1'),
	            'fields' => array('count(Pdetail.project_id) as total_num_task', 'Project.*', 'Team.*')
        	);
		
		$pagination = $this->paginate('Team');
		$this->set('team', $pagination);
		//var_dump($pagination);
		//$this->set('projects', $pagination);
	}
}
