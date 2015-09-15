<div class="container-fluid projects form">
<h3>Modify Issue</h3>
<?php 
foreach ($pdetails as $Pdetail):
	echo $this->Form->create('Pdetail');
	echo "<div class='form-group'>";
	echo $this->Form->input('date', array('label' => 'Date Assigned', 'type' => 'text', 'value' => $Pdetail['Pdetail']['date'], 'class' => 'form-control'));
	echo "</div>
		 <div class='form-group'>";
	echo $this->Form->input('issue_no', array('label' => 'Issue No.', 'type' => 'text', 'value' => $Pdetail['Pdetail']['issue_no'], 'class' => 'form-control'));
	echo "</div>
		<div class='form-group'>";
	echo $this->Form->input('sub_task', array('label' => 'Sub Task Description', 'type' => 'textarea', 'value' => $Pdetail['Pdetail']['sub_task'], 'class' => 'form-control'));
	echo "</div>
		<div class='form-group'>";
	echo $this->Form->input('task_description', array('label' => 'Task Description', 'type' => 'textarea', 'value' => $Pdetail['Pdetail']['task_description'], 'class' => 'form-control'));
	echo "</div>
		<div class='form-group'>";
	echo $this->Form->input('member', array(
		'type'=>'select', 
		'label' => 'Assignee', 
		'empty' => 'Please Select',
		'selected' => $Pdetail['Pdetail']['member'],
		'class' => 'form-control'
		)
	);
	echo "</div>
	 	<div class='form-group'>";
	echo $this->Form->input('issue_link', array('label' => 'Issue Link', 'type' => 'text', 'value' => $Pdetail['Pdetail']['issue_link'], 'class' => 'form-control'));
	echo "</div>
		<div class='form-group'>";
	echo $this->Form->input('status', array(
		'type'=>'select', 
		'label' => 'Status', 
		'empty' => 'Please Select',
		'default' => $Pdetail['Pdetail']['status'],
		'selected' => $Pdetail['Pdetail']['status'],
		'class' => 'form-control',
		'options' => array(
				'0' => 'Inactive',
				'1' => 'In Progress',
				'2' => 'Pending',
				'3' => 'For Confirmation',
				'4' => 'For Testing',
				'5' => 'Released',
				'6'	=> 'Closed'
				)
			)
		);
	echo "</div>
		<div class='form-group'>";	
	echo $this->Form->label('Created Date: '). $Pdetail['Pdetail']['created'];
	echo "</div>
		<div class='form-group'>";
	echo $this->Form->label('Modified Date: '). $Pdetail['Pdetail']['modified'];
	echo "</div>
		<div class='form-group'>";
	echo $this->Form->input('id', array('type' => 'hidden', 'value' => $Pdetail['Pdetail']['id']));
	echo "</div>";
?>
<div class="submit">
	    <input type="submit" value="Save" class="btn btn-primary" />
	    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	</div>
<?php endforeach; ?>
</div>
