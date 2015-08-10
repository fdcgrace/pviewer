<div class="container-fluid">
<legend><?php echo __('Add Issue'); ?></legend>
	<div class="row">
		<div class="col-md-2">
			<ul>

				<li><?php echo $this->Html->link(__('List Issue'), array('action' => 'index', $p_id)); ?></li>
			</ul>
		</div>
		<div class="col-md-10">
		<?php echo $this->Form->create('Pdetail'); ?>
			<fieldset>
				
			<?php
				echo $this->Form->input('project_id', array('label' => 'Project Name'));
				echo $this->Form->input('issue_no', array('label' => 'Issue number'));
				echo $this->Form->input('sub_task', array('label' => 'Sub Task Description'));
				echo $this->Form->input('task_description', array('label' => 'Task Description'));
				echo $this->Form->input('member', array('label' => 'Assign To'));
				echo $this->Form->input('issue_link', array('label' => 'Issue link'));
				echo $this->Form->input('status', array(
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
			?>
			</fieldset>
		<?php echo $this->Form->end(__('Submit')); ?>
		</div>
		
	</div>
</div>
