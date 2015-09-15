<?php
App::uses('AppModel', 'Model');
/**
 * Project Model
 *
 */
class Member extends AppModel {
	public $displayField = 'team';

	public $validate = array(
		'member' => array(
			'nonEmpty' => array(
                'rule' => array('notEmpty'),
                'allowEmpty' => false
            )
		)
	);

	public $belongsTo = array(
		'Team' => array(
			'className' => 'Team',
			'foreignKey' => 'team_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);


	function beforeSave($options = array()) {
		if(!empty($_POST['member_id'])){
			$conditions = array('conditions' => array('member' => $this->data[$this->alias]['member'], 'Member.id != ' => $_POST['member_id']));
		} else {		
			$conditions = array('conditions' => array('member' => $this->data[$this->alias]['member']));	
		}
		$check = $this->find('all', $conditions);
		if(count($check) == 0){
			return true;
		} else {
			return false;
		}
	}
	
}
