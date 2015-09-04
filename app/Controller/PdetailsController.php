<?php
App::uses('AppController', 'Controller');
/**
 * Projects Controller
 *
 * @property Project $Project
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class PdetailsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
	public $helper = array('Form', 'Html', 'Js');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view() {
	
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
		$view = new View($this, false);
		return $view->element('editIssue');
	}

/**
 * add method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function add() {
		$this->autoRender = false;
		$view = new View($this, false);
		return $view->element('newIssue');
	}

	public function delete() {
		
	}

	public function deleteBugInfo()	{

	}

	public function deleteLegend()	{

	}

	public function editLegend() {

	}

	public function insertLegend()	{

	}

	public function test821() {

	}

	public function getModifiedFiles()	{

	}

	public function insertText() {

	}


	public function updateBugInfo()	{

	}

	public function insertBugInfo()	{

	}

	public function viewBugInfo() {

	}

	public function editBugInfo()	{

	}

	public function insertFiles()	{

	}

	public function getIssueFiles()	{

	}

	public function testJson()	{

	}
	public function downloadFile()	{
	}


	public function update() {
	}

}

