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

	public $uses = array('Project', 'Pdetail', 'Member', 'Tblcolor','Issue_spec');

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
				'project.id' => $id
			);

		$this->paginate = array(
          
            'conditions' => $condition,
            'order' => 'TblColor.status_id desc'
        );

		


		$pdetails = $this->paginate('Pdetail');
		$this->set('pdetails', $pdetails);

		$projectID = (isset($pdetails[0]['Pdetail']['project_id']))? $pdetails[0]['Pdetail']['project_id']: 0;
		
		$this->set('p_id', $projectID);


		if ($this->request->is(array('post', 'put'))) {

				
			if(!empty($_POST['changeColor']) && !empty($_POST['color'])) {
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

	public function delete($id = null) {
		$this->Pdetail->id = $id;
		if (!$this->Pdetail->exists()) {
			throw new NotFoundException(__('Invalid project'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Pdetail->delete()) {
			$this->Session->setFlash(__('The project has been deleted.'));
		} else {
			$this->Session->setFlash(__('The project could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
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

		$findModified = $this->Issue_spec->find('all', array(
			'fields' => array(
				'specs_id','file','type','id','date_modified'			
				),
			'conditions' => array('issue_id' => $issueId,'specs_id' => 2),
			'order' => 'date_modified desc'
			)
		);
		$extractModified = Set::extract('/Issue_spec/.', $findModified);
		echo json_encode($extractModified);

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
	public function insertFiles()
	{
		$this->autoRender = false;
		 if ($this->request->is('post')) {
		 	$count = count($this->data['pdetails']['file']);
		 	$arrayDates = array();
		 	//echo $count.'fg';
		 	//debug($this->data['pdetails']);


			



			//var_dump($arrayDates);

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
		// 	$this->redirect($this->referer());
           
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

}

