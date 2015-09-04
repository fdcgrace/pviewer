<?php
App::uses('AppModel', 'Model');
/**
 * Project Model
 *
 */
class Pdetail extends AppModel {
	public $actsAs = array('Containable');
	
	public $belongsTo = array(
		'Project' => array(
			'className' => 'Project',
			'foreignKey' => 'project_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'TblColor' => array(
			'className' => 'Tblcolor',
			'foreignKey' => 'status',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Member' => array(
			'className' => 'Member',
			'foreignKey' => 'member',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);
}
