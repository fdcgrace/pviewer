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
		//$this->Teams->recursive = 0;
		//var_dump($this->Team->find('all'));
		//$this->set('team', $this->Paginator->paginate());

		$team = $this->Team->find('all');
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
		}
		//var_dump($arr);
		$this->set('team', $arr);
		//var_dump($this->Paginator->paginate());
	}
}
