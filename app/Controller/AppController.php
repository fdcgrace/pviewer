<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	public $priorityBar;
	public $progressBar;
	public $pdetailStatus;

	
	public function beforeFilter() {
		$this->priorityBar = array(
			1 => 'Lowest',
			2 => 'Medium',
			3 => 'Highest'
		);

		$this->progressBar = array(
			0 => 0,
			10 => 10,
			20 => 20,
			30 => 30,
			40 => 40,
			50 => 50,
			60 => 60,
			70 => 70,
			80 => 80,
			90 => 90,
			100 => 100
		);

		$this->getStatus = array(
				0 => 'Deactivate',
				1 => 'Activate'
			);
		$this->set('priorityBar',$this->priorityBar);
		$this->set('progressBar',$this->progressBar);
		$this->set('getStatus',$this->getStatus);
		$this->set('deactivate','Deactivate');
		$this->set('activate','Activate');
	}
}
