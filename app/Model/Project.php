<?php
App::uses('AppModel', 'Model');
/**
 * Project Model
 *
 */
class Project extends AppModel {
	public $actsAs = array('Containable');

	public $validate = array(
				'p_name' => array(
					'nonEmpty' => array(
						'rule' => array('notEmpty'),
						'message' => 'Project name is required.',
						'allowEmpty' => false
					)
				),
				'link' => array(
					'rule' => array('url', true), 
					'required' => true, 
				    'allowEmpty' => false, 
				    
				    'message' => '* Please enter a valid URL.', 

					
				),
				'team_id' => array(
					'nonEmpty' => array(
						'rule' => array('notEmpty'),
						'message' => 'Team is required.',
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
		)
	);
	public $hasMany = array(
		'Pdetail' => array(
			'className' => 'Pdetail',
			'foreignKey' => 'project_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
}
