<div class="modal-header projects form">
	<h4 class="modal-title" id="myModalLabel"><?php echo __('Edit Project'); ?></h4>
</div>
<div class="modal-body">
	<?php echo $this->Form->create('Project'); ?>
	<fieldset>
	<?php 
		echo $this->Form->input('id', array('label' => false, 'type' => 'hidden'));
		echo "<div class='form-group'>";
		echo $this->Form->input('p_name', array('label' => 'Project Name', 'class' => 'form-control'));
		echo "</div>
			<div class='form-group'>";
		echo $this->Form->input('link', array('label' => 'Project Link', 'class' => 'form-control'));
		echo "</div>
			 <div class='form-group'>";
		echo $this->Form->input('team_id', array('label' => 'Team', 'class' => 'form-control', 'type' => 'select', 'options' => $teams, 'empty' => 'Please Select Team', 'selected' => $data['Project']['team_id']));
		echo "</div>";
	?>
	</fieldset>
	<div class="modal-footer submit">
		<input type="submit" value="Save" class="btn btn-primary" />
	    <?php //echo $this->Form->postLink(__('Delete'), array('action' => 'deactivate', $this->Form->value('Project.id')), array('class' => 'btn btn-warning'), __('Are you sure you want to delete # %s?', $this->Form->value('Project.id'))); ?>
	    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	</div>
</div>
