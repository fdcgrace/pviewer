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

	public $uses = array('Project', 'Pdetail', 'Member', 'Tblcolor','Issue_spec','Bug_info');

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
				/*'Pdetail.priority' => 'desc'*/
				'Pdetail.status' => 'asc'
			);

		$this->paginate = array(

          
            'conditions' => $condition,
            'order' => 'TblColor.status_id desc'
        );

		


		$pdetails = $this->paginate('Pdetail');
		$this->set('pdetails', $pdetails);

		$projectID = (isset($pdetails[0]['Pdetail']['project_id']))? $pdetails[0]['Pdetail']['project_id']: 0;
		$teamID = $pdetails[0]['Pdetail']['team_id'];
		
		$this->set('t_id', $teamID);
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

				$r = trim($_POST['changeColor']);	

				$getData = $this->Tblcolor->find('first', array(
					'conditions' => array('status' => $r),
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
		$legendColorModal = $this->Tblcolor->find('all', array(
			'fields' => array(
				'color', 'status','status_id'				
				)
			)
		);
		$legendColorStatus = $this->Tblcolor->find('list', array(
			'fields' => array(
				'status_id', 'color'				
				)
			)
		);

		$legendStatusId = $this->Tblcolor->find('list', array(
			'fields' => array(
				'status_id','status'			
				)
			)
		);


		
		
		$this->set('legendColorModal', $legendColorModal);
		$this->set('legendColorStatus', $legendColorStatus);
		$this->set('legendColor', $legendColor);
		$this->set('legendStatusId', $legendStatusId);
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
		
		//var_dump($_POST); die();
		$this->autoRender = false;
		$content = array();
		$this->Pdetail->recursive = 0;
		$condition = array(
				'pdetail.id' => $id
			);

		$this->paginate = array(
            'limit' => 5,
            //'order' => $order,
            'conditions' => $condition
        );

		 $pdetails = $this->paginate('Pdetail');


		 $content['pdetails'] = $pdetails;
		//$this->set('pdetails', $pdetails);
	
		$projectID = $pdetails[0]['Pdetail']['project_id'];

		$content['projectID'] = $projectID;
		//$this->set('p_id', $projectID);

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

		$content['members'] = $members;

		//$this->set(compact('members'));

		$legendColor = $this->Tblcolor->find('list', array(
			'fields' => array(
				'color', 'status'				
				)
			)
		);
		$content['legendColor'] = $legendColor;
		//$this->set('legendColor', $legendColor);
		$view = new View($this, false);
/*var_dump($pdetails);
		 die();*/
    	return $view->element('pdetailsEdit', array('content' => $content));

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
	public function deleteBugInfo()
	{
		

		 $this->autoRender = false;
		 $bugId = $_POST['bugId'];
		 $this->Bug_info->delete($bugId);
		 echo json_encode($bugId);
	}
	public function deleteLegend()
	{
		 $this->autoRender = false;
		 $status = $_POST['status'];
	     $user = $this->Tblcolor->findByStatus($status);
		 $this->Tblcolor->delete($user['Tblcolor']['id']);
		 echo json_encode($user['Tblcolor']['id']);
	}
	public function editLegend()
	{
		 $this->autoRender = false;
		$statusOld = $_POST['statusOld'];
		$statusNew = $_POST['statusNew'];
		$statusFindNew['Tblcolor']['id'] = null;
		 $statusFind = $this->Tblcolor->findByStatus($statusOld);
		 $statusFindNew = $this->Tblcolor->findByStatus($statusNew);
		 $statusIdNew = $statusFindNew['Tblcolor']['id'];

		 if($statusIdNew == '' || $statusIdNew == null)
		 {

			 $statusId = $statusFind['Tblcolor']['id'];
			 $this->Tblcolor->id = $statusId;
			 $this->Tblcolor->set(array(
			      'status' => $statusNew,
				));
			 $this->Tblcolor->save();

			 echo json_encode(1);
		 }
		 else
		 {
		 	echo json_encode(0);
		 }
	}
	public function insertLegend()
	{
		
		$this->autoRender = false;
		$newStatus = $_POST['newStatus'];
		$colorStatus = $_POST['colorStatus'];


		$maxstat = $this->Tblcolor->find('all',array('fields' => 'MAX(status_id) as maxstat'));


		$ifStatusExists = $this->Tblcolor->find('count',array('conditions' => array('OR' => array('status' => $newStatus,'status' => trim($newStatus)))));
		if($ifStatusExists <= 0)
		{
		$this->Tblcolor->set(array(
			      'status' => $newStatus,
			      'status_id' => $maxstat[0][0]['maxstat']+1,
			      'color' => $colorStatus
				));
		 $this->Tblcolor->save();
		 echo json_encode(1);
		}
		else
		echo json_encode(0);
	}
	public function test821()
	{
		$t = $_FILES['userfile'];
		echo "<script>alert('$t')</script>";
		if(isset($_FILES['userfile']))
		{
			echo "<script>alert('dfdfdfdf')</script>";
		       /* for($i=0;$i<count($_FILES['userfile']['name']);$i++)
		        {

		        $uploaddir = 'uploads/';
		        $uploadfile = $uploaddir . basename($_FILES['userfile']['name'][$i]);

		        echo '<pre>';
		        if (move_uploaded_file($_FILES['userfile']['tmp_name'][$i], $uploadfile)) {
		            echo "File is valid, and was successfully uploaded.\n";
		        } else {
		            echo "Possible file upload attack!\n";
		        }

		        }

		        echo 'Here is some more debugging info:';
		        print_r($_FILES);

		        print "</pre>";
*/
		}
	}
	public function getModifiedFiles()
	{
		$this->autoRender = false;
		$issueId = $_POST['issueId'];
		$type = $_POST['type'];

		if($type == 'modified')
		{
			$findModified = $this->Issue_spec->find('all', array(
				'fields' => array(
					'specs_id','file','type','id',"`date_modified` AS `date`"			
					),
				'conditions' => array('issue_id' => $issueId,'specs_id' => 2),
				'order' => 'date_modified desc'
				)
			);
			$extractModified = Set::extract('/Issue_spec/.', $findModified);
			echo json_encode($extractModified);
		}
		else if($type == 'released')
		{
			$findReleased = $this->Issue_spec->find('all', array(
				'fields' => array(
					'specs_id','file','type','id',"`date_released` AS `date`"			
					),
				'conditions' => array('issue_id' => $issueId,'specs_id' => 3),
				'order' => 'date_released desc'
				)
			);
			$extractReleased = Set::extract('/Issue_spec/.', $findReleased);
			echo json_encode($extractReleased);
		}

	}
	public function insertText()
	{
		$this->autoRender = false;
		if ($this->request->is('post')) {
		 	$count = count($this->data['pdetails']['text']);
		 	echo $count.'fg';
		 	debug($this->data['pdetails']);

		 	for($i=0;$i<$count;$i++)
	        {

	    //		echo $this->data['pdetails']['file'][$i]['name'].'sharona';
	        		
	        	$this->Issue_spec->create();
	        	
	        		$data = 
						    array(
						        'Issue_spec' => array(
						            'issue_id'=>$this->data['pdetails']['issueid'],
						            'specs_id'=>$this->data['pdetails']['specsid'],
						            'file'=>$this->data['pdetails']['text'][$i],
						            'type'=>$this->data['pdetails']['type']
						        )
						    
						);


		//		debug($data);			    
				 $this->Issue_spec->save($data);
				 /*$filename = "C:/xampp/htdocs/pviewer/app/webroot/files/".$this->data['pdetails']['category'].'/'.$this->data['pdetails']['text'][$i];	
				 echo '<pre>';
		        if (move_uploaded_file($this->data['pdetails']['file'][$i]['tmp_name'], $filename)) {
		            echo "File is valid, and was successfully uploaded.\n";
		        } else {
		            echo "Possible file upload attack!\n";
		        }	  */  
	       
						
						


		       

		        

	        }
		 	
           
        //   echo $filename;

	        $this->redirect($this->referer());

       	 }	
	}


	public function updateBugInfo()
	{
		$this->autoRender = false;
		 if ($this->request->is('post')) {	

		 	$issueidbug = $this->data['pdetails']['issueid-bug'];
			$bugDescription  = $this->data['pdetails']['bugdescription'];
			$bugSteps = $this->data['pdetails']['bugsteps'];
			$bugStatus = $this->data['pdetails']['bugstatus'];
			$statusAfter = $this->data['pdetails']['statusAfter'];
			$whoFound = $this->data['pdetails']['whofound'];
			$bugReason = $this->data['pdetails']['bugreason'];


			$data = 
						    array(
						            'bug_description'=>$bugDescription,
						            'bug_steps'=>$bugSteps,
						            'bug_status'=>$bugStatus,
						            'status_after'=>$statusAfter,
						            'who_found'=>$whoFound,
						            'bug_reason'=>$bugReason
						        
						    
						);

				 $this->Bug_info->id = $issueidbug;
				 $this->Bug_info->set($data);
				 $this->Bug_info->save();



		 }
		 	$this->redirect($this->referer());
	}
	public function insertBugInfo()
	{
		 $this->autoRender = false;
		 if ($this->request->is('post')) {	

		 	$issueidbug = $this->data['pdetails']['issueid-bug'];
			$bugDescription  = $this->data['pdetails']['bugdescription'];
			$bugSteps = $this->data['pdetails']['bugsteps'];
			$bugStatus = $this->data['pdetails']['bugstatus'];
			$statusAfter = $this->data['pdetails']['statusAfter'];
			$whoFound = $this->data['pdetails']['whofound'];
			$bugReason = $this->data['pdetails']['bugreason'];


			$id  = $this->Bug_info->find('all', array(
			'conditions' => array('issue_id' => $issueidbug)
			)
			);

		/*	if(count($id) > 0)
			{
				echo "a";
				$bugIssueId = $id[0]['Bug_info']['id'];
				$data = 
						    array(
						            'bug_description'=>$bugDescription,
						            'bug_steps'=>$bugSteps,
						            'bug_status'=>$bugStatus,
						            'status_after'=>$statusAfter,
						            'who_found'=>$whoFound,
						            'bug_reason'=>$bugReason
						        
						    
						);

				 $this->Bug_info->id = $bugIssueId;
				 $this->Bug_info->set($data);
				 $this->Bug_info->save();

			}
			else
			{*/

				$this->Bug_info->create();

				$data = 
							  array(
							        'Bug_info' => array(
							            'issue_id'=>$issueidbug,
							            'bug_description'=>$bugDescription,
							            'bug_steps'=>$bugSteps,
							            'bug_status'=>$bugStatus,
							            'status_after'=>$statusAfter,
							            'who_found'=>$whoFound,
							            'bug_reason'=>$bugReason
							        )
							    
							);
		    
				 $this->Bug_info->save($data);
			//}

	



		 }
		  	$this->redirect($this->referer());
	}
	public function viewBugInfo()
	{
		$this->autoRender = false;
		$issueId = $_POST['issueId'];

		$infoRecord = $this->Bug_info->find('all', array(
			'conditions' => array('issue_id' => $issueId)
			)
		);

		$returnInfo = Set::extract('/Bug_info/.', $infoRecord);

		echo json_encode($returnInfo);

	}
	public function editBugInfo()
	{
		$this->autoRender = false;
		$bugId = $_POST['bugId'];

		$infoRecord = $this->Bug_info->find('all', array(
			'conditions' => array('id' => $bugId)
			)
		);

		$returnInfo = Set::extract('/Bug_info/.', $infoRecord);

		echo json_encode($returnInfo);
	}
	public function insertFiles()
	{
		$this->autoRender = false;
		 if ($this->request->is('post')) {
		 	$count = count($this->data['pdetails']['file']);
		 	$arrayDates = array();

		 	for($i=0;$i<$count;$i++)
	        {
	        	$fileName = $this->data['pdetails']['file'][$i]['name'];
				$tmpName  = $this->data['pdetails']['file'][$i]['tmp_name'];
				$fileSize = $this->data['pdetails']['file'][$i]['size'];
				$fileType = $this->data['pdetails']['file'][$i]['type'];

				
			
				$fp      = fopen($tmpName, 'r');
				$content = fread($fp, filesize($tmpName));
				$content = addslashes($content);
				fclose($fp);

	    		//echo $this->data['pdetails']['file'][$i]['name'].'sharona';
	        		
	        	$this->Issue_spec->create();
	        	
	        		$data = 
						    array(
						        'Issue_spec' => array(
						            'issue_id'=>$this->data['pdetails']['issueid'],
						            'specs_id'=>$this->data['pdetails']['specsid'],
						            'file'=>$this->data['pdetails']['file'][$i]['name'],
						            'type'=>$this->data['pdetails']['type'],
						            'type2' => $fileType,
						            'size' => $fileSize,
						            'content' => $content
						            
						        )
						    
						);
						if(isset($this->data['pdetails']['dateModified']))
					 	$data['Issue_spec']['date_modified'] = $this->data['pdetails']['dateModified'];
						else
						$data['Issue_spec']['date_released'] = $this->data['pdetails']['dateReleased'];    

				 $this->Issue_spec->save($data);
				 $filename = "C:/xampp/htdocs/pviewer/app/webroot/files/".$this->data['pdetails']['category'].'/'.$this->data['pdetails']['file'][$i]['name'];	
				 echo '<pre>';
		        if (move_uploaded_file($this->data['pdetails']['file'][$i]['tmp_name'], $filename)) {
		            echo "File is valid, and was successfully uploaded.\n";
		        } else {
		            echo "Possible file upload attack!\n";
		        }	    
	       
						
						 

		       //	
		       

		        

	        }
		 	$this->redirect($this->referer());
           
    //       echo $filename;
	   //      $this->redirect($this->referer());



       	 }	
	}
	public function getIssueFiles()
	{
		$this->autoRender = false;
		$issueid = $_POST['issueid'];
		$r = '';
		$legendStatusId = $this->Issue_spec->find('all', array(
			'fields' => array(
				'specs_id','file','type','id'			
				),
			'conditions' => array('issue_id' => $issueid)
			)
		);
	
		foreach ($legendStatusId as $key => $value) {
			$fileId = $value['Issue_spec']['id'];
			$fileLink = '<a href="<?php  echo  ?>">'.$value['Issue_spec']['file'].'</a>';
			$r .= $value['Issue_spec']['file'].'|'.$value['Issue_spec']['specs_id'].'|'.$value['Issue_spec']['type'].'|'.$fileId.'@';	
		}

		echo $r;
		//$result = Set::combine($legendStatusId, '{n}.Issue_spec.id', '{n}.Issue_spec.file', '{n}.Issue_spec.type', '{n}.Issue_spec.specs_id');
		
		//echo json_encode($result);
	}
	public function testJson()
	{
		$this->autoRender = false;
		

		$legendStatusId = $this->Issue_spec->find('all', array(
			'fields' => array(
				'specs_id','file','type','id'			
				),
			'conditions' => array('issue_id' => 4)
			)
		);
		echo $today;

		$things = Set::extract('/Issue_spec/.', $legendStatusId);
		//debug($things);
//$userNames = Set::extract($legendStatusId, '{n}.Issue_spec.file','Issue_spec.type');



//debug($userNames);
	echo json_encode($things);
	}
	public function downloadFile()
	{
		$this->autoRender = false;
		$id= $_GET['id'];

		$fileDownload = $this->Issue_spec->find('all', array(
			'fields' => array(
				'file','type2','size','content'			
				),
			'conditions' => array('id' => $id)
			)
		);
		$file = $fileDownload[0]['Issue_spec']['file'];
		$type2 =  $fileDownload[0]['Issue_spec']['type2'];
		$size =  $fileDownload[0]['Issue_spec']['size'];
		$content =  $fileDownload[0]['Issue_spec']['content'];	

		header("Content-length: $size");
		header("Content-type: $type2");
		header("Content-Disposition: attachment; filename=$file");
		echo stripslashes($content);
	}


	public function update() {
		$this->autoRender = false;

		debug($this->request->data);die();
		if($this->request->is('ajax')) {
			$this->Pdetail->id = $this->request->data['id'];
			$this->Pdetail->save($this->request->data);
		}
	}

}

