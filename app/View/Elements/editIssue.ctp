<div class="modal-header projects form">
	<h4 class="modal-title" id="myModalLabel"><?php echo __('Modify Issue'); ?></h4>
</div>
<div class="modal-body">
	<?php 
		echo $this->Form->create('Pdetail');
		echo "<div class='form-group'>";
		echo $this->Form->input('deadline', array('label' => 'Deadline', 'type' => 'text', 'value' => '2015-10-01', 'class' => 'form-control datepicker', 'id' => 'end'));
		echo $this->Form->input('start_date', array('label' => 'Start Date', 'type' => 'text', 'value' => '2015-08-18', 'class' => 'form-control datepicker', 'id' => 'start'));
		echo "</div>
			 <div class='form-group'>";
		echo $this->Form->input('issue_no', array('label' => 'Issue No.', 'type' => 'text', 'value' => '7874', 'class' => 'form-control'));
		echo "</div>
			<div class='form-group'>";
		echo $this->Form->input('sub_task', array('label' => 'Sub Task Description', 'type' => 'textarea', 'value' => 'Test', 'class' => 'form-control'));
		echo "</div>
			<div class='form-group'>";
		echo $this->Form->input('task_description', array('label' => 'Task Description', 'type' => 'textarea', 'value' => 'Testing', 'class' => 'form-control'));
		echo "</div>
			<div class='form-group'>";
		echo $this->Form->input('member', array(
			'type'=>'select', 
			'label' => 'Assignee', 
			'empty' => 'Please Select',
			'class' => 'form-control'
			)
		);
		echo "</div>
		 	<div class='form-group'>";
		echo $this->Form->input('issue_link', array('label' => 'Issue Link', 'type' => 'text', 'value' => 'http://redmine.vjsol.jp/issues/7874', 'class' => 'form-control'));
		echo "</div>
			<div class='form-group'>";
		echo $this->Form->input('status', array(
			'type'=>'select', 
			'label' => 'Status', 
			'empty' => 'Please Select',
			'default' => 'For Testing',
			'selected' => 'For Testing',
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
		echo $this->Form->label('Created Date: ').'0000-00-00';
		echo "</div>
			<div class='form-group'>";
		echo $this->Form->label('Modified Date: ').'0000-00-00';
		echo "</div>
			<div class='form-group'>";
		echo $this->Form->input('id', array('type' => 'hidden', 'value' => 1));
		echo "</div>";
	?>
	<div class="submit">
		    <input type="submit" value="Save" class="btn btn-primary" />
		    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	</div>
</div>

<script>
$(document).ready(function() {
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