<?php
App::uses('AppController', 'Controller');
/**
 * Projects Controller
 *
 * @property Project $Project
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class PdetailsController extends AppController {

	public $uses = array('Project', 'Pdetail', 'Member', 'Tblcolor');

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
	public $helper = array('Form', 'Html', 'Js');

/**
 * index method
 *
 * @return void
 */
	public function index($id = null) {
		$this->Pdetail->recursive = 0;
		$condition = array(
				'project.id' => $id,
				'Pdetail.del_flg' => 1
			);
		$order = array(
				'Pdetail.priority' => 'desc'
			);

		$this->paginate = array(
            'limit' => 5,
            'conditions' => $condition,
            'order' => $order
        );

		$pdetails = $this->paginate('Pdetail');
		$this->set('pdetails', $pdetails);

		$projectID = (isset($pdetails[0]['Pdetail']['project_id']))? $pdetails[0]['Pdetail']['project_id']: 0;
		
		$this->set('p_id', $projectID);


		if ($this->request->is(array('post', 'put'))) {
			if((isset($_POST['progress']) && $_POST['progress']!='') && (isset($_POST['id']) && (!empty($_POST['id'])))){
			//if($_POST['progress']!='' && !empty($_POST['id'])){
				$arrData = array('progress' => $_POST['progress']);
				$this->Pdetail->id = $_POST['id'];
				$this->Pdetail->set($arrData);
		        if($this->Pdetail->save()){
		           $this->Session->setFlash(__('The details has been saved.'));
		        }else{
		            $this->Session->setFlash(__('The details could not be updated. Please, try again.'));
		        } 
		    } else if((isset($_POST['priority']) &&!empty($_POST['priority'])) && (isset($_POST['id']) && !empty($_POST['id']))){
		    //} else if(!empty($_POST['priority']) && !empty($_POST['id'])){
				$arrData = array('priority' => $_POST['priority']);
				$this->Pdetail->id = $_POST['id'];
				$this->Pdetail->set($arrData);
		        if($this->Pdetail->save()){
		           $this->Session->setFlash(__('The details has been saved.'));
		        }else{
		            $this->Session->setFlash(__('The details could not be updated. Please, try again.'));
		        } 
			}else if(!empty($_POST['changeColor']) && !empty($_POST['color'])) {
				$getData = $this->Tblcolor->find('first', array(
					'conditions' => array('status' => $_POST['changeColor']),
					'fields' => array('id')
					));
				$idColor = $getData['Tblcolor']['id'];
				$arrData = array('color' => $_POST['color']);
				$this->Tblcolor->id = $idColor;
				$this->Tblcolor->set($arrData);
		        if($this->Tblcolor->save()){
		           $this->Session->setFlash(__('The details has been saved.'));
		        }else{
		            $this->Session->setFlash(__('The details could not be updated. Please, try again.'));
		        } 
			}else{
				
				if ($this->Pdetail->save($this->request->data)) {
					$this->Session->setFlash(__('The details has been updated.'));
					return $this->redirect(array('action' => 'index', $id));
				} else {
					
				}
			}
			
			
		} else {
			$options = array('conditions' => array('Pdetail.' . $this->Pdetail->primaryKey => $id, 'Pdetail.del_flg' => 1));
			$this->request->data = $this->Pdetail->find('first', $options);
		}

		$members = $this->Pdetail->Member->find('list', array(
			'fields' => array('member')
			)
		);

		$this->set(compact('members'));

		$legendColor = $this->Tblcolor->find('list', array(
			'fields' => array(
				'color', 'status'				
				)
			)
		);

		$this->set('legendColor', $legendColor);
		if($this->request->is('ajax')){
			$this->layout = 'default';
			$this->render('index','ajax');
        }

	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Pdetail->exists($id)) {
			throw new NotFoundException(__('Invalid ID'));
		}
		$options = array('conditions' => array('Pdetail.' . $this->Pdetail->primaryKey => $id));
		$this->set('Pdetail', $this->Pdetail->find('first', $options));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Pdetail->recursive = 0;
		$condition = array(
				'pdetail.id' => $id
			);

		$this->paginate = array(
            'limit' => 5,
            'conditions' => $condition
        );

		$pdetails = $this->paginate('Pdetail');
		$this->set('pdetails', $pdetails);

		$projectID = $pdetails[0]['Pdetail']['project_id'];

		$this->set('p_id', $projectID);

		if ($this->request->is(array('post', 'put'))) {
			if ($this->Pdetail->save($this->request->data)) {
				$this->Session->setFlash(__('The details has been updated.'));
				return $this->redirect(array('action' => 'index', $projectID));
			} else {
				$this->Session->setFlash(__('The details could not be updated. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Pdetail.' . $this->Pdetail->primaryKey => $id));
			$this->request->data = $this->Pdetail->find('first', $options);
		}

		$members = $this->Pdetail->Member->find('list', array(
			'fields' => array(
				'member'
				)
			)
		);

		$this->set(compact('members'));

		$legendColor = $this->Tblcolor->find('list', array(
			'fields' => array(
				'color', 'status'				
				)
			)
		);

		$this->set('legendColor', $legendColor);

	}

/**
 * add method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function add($id = null) {
		$projectID = $id;

		$this->set('p_id', $projectID);
		
		if ($this->request->is('post')) {
			$this->Pdetail->create();
			if ($this->Pdetail->save($this->request->data)) {
				$this->Session->setFlash(__('The issue has been saved.'));
				return $this->redirect(array('action' => 'index', $id));
			} else {
				$this->Session->setFlash(__('The issue could not be saved. Please, try again.'));
			}
		}

		$projects = $this->Pdetail->Project->find('list', array(
			'fields' => array(
				'p_name'
				)
			)
		);

		$this->set(compact('projects'));

		$members = $this->Pdetail->Member->find('list', array(
			'fields' => array(
				'member'
				)
			)
		);

		$this->set(compact('members'));
	}

	public function delete($id = null, $project_id = null) {
		echo "index/".$project_id;
		$this->Pdetail->id = $id;
		//$getData = $this->Pdetail->find('first', array('field' => array('Pdetail.project_id'), 'conditions' => array('Pdetail.id' => $id)));		//die();
		//$project_id = $getData['Pdetail']['project_id'];
		
		if (!$this->Pdetail->exists()) {
			throw new NotFoundException(__('Invalid project'));
		}
		//if ($this->Pdetail->delete()) {
		if ($this->Pdetail->saveField('del_flg', 0)) {	
			$this->Session->setFlash(__('The project has been deleted.'));
		} else {
			$this->Session->setFlash(__('The project could not be deleted. Please, try again.'));
		}

	//	return $this->redirect(array('action' => 'index'));

		$this->redirect(array('action' => 'index', $project_id));

	}
}

