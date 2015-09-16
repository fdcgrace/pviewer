<?php
App::uses('AppController', 'Controller');
/**
 * Projects Controller
 *
 * @property Project $Project
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ArchivesController extends AppController {

	public $uses = array('Project', 'Pdetail', 'Team','Member');

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

	public function beforeFilter() {
		parent::beforeFilter();
		$this->set('controllerID', 1);
	}

	public function viewArchive()
	{
			$project = $this->Project->find('all',array('conditions' =>
				array('Project.del_flg' => 0)
				));

			$view = new View($this, false);
		    $blah =  $view->element('testing');

			$this->set('deletedProject', $project);
			$this->set('blah', $blah);
	}

	public function getProjects(){
		$condition = array('Project.del_flg' => 0);
		if(isset($_POST['search']))
			{
				$search = $_POST['search'];
				$condition[] = array('OR' => array('Project.p_name LIKE' => '%'.$search.'%', 'Project.link LIKE' => '%'.$search.'%', 'Team.team LIKE' => '%'.$search.'%', 'Project.created LIKE' => '%'.$search.'%') );
			}

		$this->autoRender = false;	
		$view = new View($this, false);

		$project = $this->Project->find('all',array('conditions' =>
				$condition
				));

		if(count($project) > 0)
		{
			$content =  $view->element('getProjects', array('deletedProject' => $project));
		}
		else
		{
			$content = '<br><center><i><h4>No data available.</h4></i></center>';
		}

	//	$content =  $view->element('getProjects', array('deletedProject' => $project));

		return $content;
	}


	public function getIssues(){
		$this->autoRender = false;
		$view = new View($this, false);


		$condition = array('Pdetail.del_flg' => 0);
		if(isset($_POST['search']))
			{
				$search = $_POST['search'];
				$condition[] = array('OR' => array('Pdetail.task_description LIKE' => '%'.$search.'%', 'Pdetail.issue_link LIKE' => '%'.$search.'%', 'Pdetail.deadline LIKE' => '%'.$search.'%', 'Pdetail.issue_no LIKE' => '%'.$search.'%', 'Member.member LIKE' => '%'.$search.'%') );
			}


		$issues = $this->Pdetail->find('all',
										array('conditions' => $condition));

		if(count($issues) > 0)
		{
			$content =  $view->element('getIssues', array('issueArray' => $issues));
		}
		else
		{
			$content = '<br><center><i><h4>No data available.</h4></i></center>';
		}

		return $content;
	}



	public function getMembers()
	{
		$this->autoRender = false;
		$view = new View($this, false);


		$condition = array('Member.del_flg' => 0);
		if(isset($_POST['search']))
			{
				$search = $_POST['search'];
				$condition[] = array('OR' => array('Member.created LIKE' => '%'.$search.'%', 'Member.modified LIKE' => '%'.$search.'%',  'Member.member LIKE' => '%'.$search.'%') );
			}


		$issues = $this->Member->find('all',
										array('conditions' => $condition));

		if(count($issues) > 0)
		{
			$content =  $view->element('getMembers', array('issueArray' => $issues));
		}
		else
		{
			$content = '<br><center><i><h4>No data available.</h4></i></center>';
		}

		return $content;
	}
	public function getLeaders()
	{
		$this->autoRender = false;
		$view = new View($this, false);

		$issues = $this->Team->find('all',array('conditions' => array('Team.del_flg' => 0)));



		$condition = array('Team.del_flg' => 0);
		if(isset($_POST['search']))
			{
				$search = $_POST['search'];
				$condition[] = array('OR' => array('Team.created LIKE' => '%'.$search.'%', 'Team.modified LIKE' => '%'.$search.'%',  'Team.team LIKE' => '%'.$search.'%') );
			}


		$storeDivisions = $this->Team->find('all',
                array('joins' => array(
                                       array('table' => 'projects',
                                             'alias' => 'Project',
                                             'type' => 'left',
                                             'conditions'=> array('Team.id = Project.team_id')
                                        )
                                 ),
                	   'fields' => array('Project.*','Team.team','Team.created','Team.modified'),
                       'conditions'=> $condition,
                       'group' => 'Project.team_id'
                ));

		$arr = array();
		foreach ($issues as $value) {

			$arr[] = $value['Team']['id'];

			
		}

		if(count($storeDivisions) > 0)
		{
			$leaders =  $view->element('getLeaders', array('issueArray' => $storeDivisions));
		}
		else
		{
			$leaders = '<br><center><i><h4>No data available.</h4></i></center>';
		}


		return $leaders;
	}
}
