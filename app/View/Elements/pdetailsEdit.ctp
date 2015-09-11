<div class="container-fluid projects form">
<h3>Modify Issue</h3>
<?php 
$pdetails = $content['pdetails'];
$stat = $content['stat'];
foreach ($pdetails as $Pdetail):
	echo $this->Form->create('Pdetail');
	echo "<div class='form-group'>";
	echo $this->Form->input('date', array('label' => 'Date Assigned', 'type' => 'text', 'value' => $Pdetail['Pdetail']['deadline'], 'class' => 'form-control'));
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
							'class' => 'form-control',
							'selected' => $Pdetail['Pdetail']['status'],
							'default' => $Pdetail['Pdetail']['status'],
							'options'=> $stat
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
<div class="buttons">
	<div class="fleft mar10"><input type="submit" value="Save" class="btn btn-primary" style="float:left" /></div>
	<div><button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button></div>
</div>
<?php endforeach; ?>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('body').on('hidden.bs.modal', '.modal', function () {
			$(this).removeData('bs.modal');
		});
	});
</script>

