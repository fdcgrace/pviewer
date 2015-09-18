<?php
App::uses('AppController', 'Controller');

class SendmailsController extends AppController {

	public $components = array('Session');

	 var $uses = array('Pdetail');

	 public function index(){
	 	$currDate = date('Y-m-d');
	 	$conditions = array(
						'AND' => array(
							array('Pdetail.deadline' <= '2015-09-18'),
							array('Pdetail.deadline' <> '0000-00-00')
						)
					);
	 	$details = $this->Pdetail->find('all', array(
	 				'conditions' => $conditions
	 			)
	 		);
	 	var_dump($conditions);
	 	echo count($details);
	 	//var_dump($details);
	 }
}

?>