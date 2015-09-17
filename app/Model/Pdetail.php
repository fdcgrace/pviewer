<?php
App::uses('AppModel', 'Model');
/**
 * Project Model
 *
 */
class Pdetail extends AppModel {
	public $actsAs = array('Containable');

	public $validate = array(
				'issue_no' => array(
					'nonEmpty' => array(
						'rule' => array('notEmpty'),
						'message' => 'Issue number is required.',
						'allowEmpty' => false
					)
				),
				'task_description' => array(
					'nonEmpty' => array(
						'rule' => array('notEmpty'),
						'message' => 'Task Description is required.',
						'allowEmpty' => false
					)
				),
				'issue_link' => array(
					'rule' => array('url', true), 
					'required' => true, 
				    'allowEmpty' => false, 
				    'message' => '* Please enter a valid URL.'
				)
			);

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
