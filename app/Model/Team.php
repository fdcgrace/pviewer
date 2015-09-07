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
		if(!empty($_POST['id'])){
			$conditions = array('conditions' => array('team' => $this->data[$this->alias]['team'], 'id != ' => $_POST['id']));
			$check = $this->find('all', $conditions);
			
			if(count($check) == 0){
				return true;
			} else {
				return false;
			}
		}
		
	}
}
