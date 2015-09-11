<div class="modal-header">
	<h4 class="modal-title" id="myModalLabel"><?php echo __('Add Issue'); ?></h4>
</div>

<div class="modal-body">
	<?php echo $this->Form->create('Pdetail', array('role' => 'form')); ?>
		<fieldset>
		<?php
			echo "<div class='form-group'>";
			echo $this->Form->input('project_id', array('label' => 'Project Name', 'class' => 'form-control'));
			echo "</div>
				 <div class='form-group'>";
			echo $this->Form->input('issue_no', array('label' => 'Issue number', 'class' => 'form-control'));
			echo "</div>
				 <div class='form-group'>";
			echo $this->Form->input('sub_task', array('label' => 'Sub Task Description', 'class' => 'form-control'));
			echo "</div>
				 <div class='form-group'>";
			echo $this->Form->input('task_description', array('label' => 'Task Description', 'class' => 'form-control'));
			echo "</div>
				 <div class='form-group'>";
			echo $this->Form->input('member', array('label' => 'Assign To', 'class' => 'form-control'));
			echo "</div>
				 <div class='form-group'>";
			echo $this->Form->input('issue_link', array('label' => 'Issue link', 'class' => 'form-control'));
			echo "</div>
				 <div class='form-group'>";
			echo $this->Form->input('status', array(
				'class' => 'form-control',
				'type'=>'select', 
				'label' => 'Status', 
				'empty' => 'Please Select',
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
			echo "</div>";
		?>
		</fieldset>
	<div class="submit modal-footer" style="margin:0 0 20px; 0">
	    <input type="submit" value="Save" class="btn btn-primary" />
	    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	</div>
</div>
