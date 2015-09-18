<?php
App::uses('AppController', 'Controller');
/**
 * Projects Controller
 *
 * @property Project $Project
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ExtrasController extends AppController {

	public $uses = array('Project', 'Pdetail', 'Team','Member');

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

	public function beforeFilter() {
		parent::beforeFilter();
		$this->set('controllerID', 5);
	}

	public function shift()
	{
			$member = $this->Member->find('all',array('conditions' =>
				array('Member.del_flg' => 1)
				));

		
			$this->set('member', $member);

	}
	public function updateShift()
	{
		$this->autoRender = false;
		$file = WWW_ROOT.'files\shift.txt';
		$content = $_POST['content'];
		file_put_contents($file,$content);
	}

}
