<?php
App::uses('AppModel', 'Model');
/**
 * Project Model
 *
 */
class Team extends AppModel {
	// public $useTable = 'Project';

	// public $hasMany = array(
	// 	'Project' => array(
	// 		'className' => 'Project',
	// 		'foreignKey' => 'project_id',
	// 		'conditions' => '',
	// 		'fields' => '',
	// 		'order' => ''
	// 	),
	// );

	public $validate = array(
		'team' => array(
			'nonEmpty' => array(
                'rule' => array('notEmpty'),
                'allowEmpty' => false
            )
		)
	);

	function beforeSave($options = array()) {
		$check = $this->find('all', array(
			'conditions' => array('team' => $this->data[$this->alias]['team']))
		);
		if(count($check) == 0){
			return true;
		} else {
			return false;
		}
	}
}
