<?php
App::uses('AppModel', 'Model');
/**
 * Project Model
 *
 */
class Member extends AppModel {
	// public $actsAs = array('Containable');
	/*public $hasMany = array(
		'Pdetail' => array(
			'className' => 'Pdetail',
			'foreignKey' => 'pdetail_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);*/

	public $validate = array(
		'member' => array(
			'nonEmpty' => array(
                'rule' => array('notEmpty'),
                'allowEmpty' => false
            )
		)
	);


	function beforeSave($options = array()) {
		$check = $this->find('all', array(
			'conditions' => array('member' => $this->data[$this->alias]['member']))
		);
		if(count($check) == 0){
			return true;
		} else {
			return false;
		}
	}
}
