<?php
App::uses('AppModel', 'Model');
/**
 * Project Model
 *
 */
class Team extends AppModel {
	public $useTable = 'Project';

	public $hasMany = array(
		'Project' => array(
			'className' => 'Project',
			'foreignKey' => 'project_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);
}
