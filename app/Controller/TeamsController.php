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

	public function index() {
	}

	public function view() {
	}

	public function team() {
		$this->autoRender =  false;
		if ($this->request->is("ajax")) {
			$view = new View($this, false);
			return $view->element('team');
		}
	}

	public function project() {
		$this->autoRender =  false;
		if ($this->request->is("ajax")) {
			$view = new View($this, false);
			return $view->element('project');
		}
	}
}
?>