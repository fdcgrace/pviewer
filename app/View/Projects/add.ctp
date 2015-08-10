<div class="container-fluid">
<legend><?php echo __('Add Project'); ?></legend>
	<div class="row">
		<div class="col-md-2">
			<ul>
				<li><?php echo $this->Html->link(__('List Projects'), array('action' => 'index')); ?></li>
			</ul>
		</div>
		<div class="col-md-10">
		<?php echo $this->Form->create('Project'); ?>
			<fieldset>
			<?php
				echo $this->Form->input('p_name', array('label' => 'Project Name'));
				echo $this->Form->input('link', array('label' => 'Link'));
				echo $this->Form->input('team_id');
			?>
			</fieldset>
		<?php echo $this->Form->end(__('Submit')); ?>
		</div>
		
	</div>
</div>