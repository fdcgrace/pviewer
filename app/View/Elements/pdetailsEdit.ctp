<div class="container-fluid projects form">
<h3>Modify Issue</h3>
<?php 
$pdetails = $content['pdetails'];
$stat = $content['stat'];
$members = $content['members'];
foreach ($pdetails as $Pdetail):
	echo $this->Form->create('Pdetail');
	echo "<div class='form-group'>";
	echo $this->Form->input('start_date', array('label' => 'Start Date', 'type' => 'text', 'value' => $Pdetail['Pdetail']['start_date'], 'class' => 'form-control datepicker', 'id' => 'start'));
	echo "</div>
		<div class='form-group'>";
	echo $this->Form->input('deadline', array('label' => 'Deadline', 'type' => 'text', 'value' => $Pdetail['Pdetail']['deadline'], 'class' => 'form-control datepicker', 'id' => 'end'));
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
		'class' => 'form-control',
		'options' => $members
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
	$(".datepicker").each(function() {
		var end = $("#end").attr('value');
  		if($(this).attr('id') == 'end') {
  			$(this).datepicker({
		      numberOfMonths: 3,
		      showButtonPanel: true,
		      dateFormat: "yy-mm-dd"
		    });
  		} else {
  			$(this).datepicker({
  				minDate: "-3M",
  				maxDate: end,
  				numberOfMonths: 2,
  				showButtonPanel: true,
  				dateFormat: "yy-mm-dd"
  			});
  		}
  	});
});
</script>


