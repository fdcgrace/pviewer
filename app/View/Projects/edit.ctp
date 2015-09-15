<div class="container-fluid projects form">
<?php echo $this->Form->create('Project'); ?>
	<fieldset>
		<legend><?php echo __('Edit Project'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo "<div class='form-group'>";
		echo $this->Form->input('p_name', array('label' => 'Project Name', 'class' => 'form-control'));
		echo "</div>
			<div class='form-group'>";
		echo $this->Form->input('link', array('label' => 'Project Link', 'class' => 'form-control'));
		echo "</div>
			 <div class='form-group'>";
		echo $this->Form->input('team_id', array('label' => 'Team', 'class' => 'form-control'));
		echo "</div>";
	?>
	</fieldset>
	<div class="submit">
	    <input type="submit" value="Save" class="btn btn-primary" />
	    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Project.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Project.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Projects'), array('action' => 'index')); ?></li>
	</ul>
</div>
