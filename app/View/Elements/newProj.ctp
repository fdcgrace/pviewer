<div class="modal-header">
	<h4 class="modal-title" id="myModalLabel"><?php echo __('Add Project'); ?></h4>
</div>

<div class="modal-body">
	<?php echo $this->Form->create('Project'); ?>
	<fieldset>
	<?php
		echo "<div class='form-group'>";
		echo $this->Form->input('p_name', array('label' => 'Project Name', 'class' => 'form-control'));
		echo "</div>
			 <div class='form-group'>";
		echo $this->Form->input('link', array('label' => 'Link', 'class' => 'form-control'));
		echo "</div>
			 <div class='form-group'>";
		echo $this->Form->input('team_id', array('class' => 'form-control', 'type' => 'select', 'options' => $teams, 'empty' => 'Please Select Team'));
		echo "</div>";
	?>
	</fieldset>
	<div class="submit modal-footer" style="margin:0 0 20px; 0">
	    <input type="submit" value="Save" class="btn btn-primary" />
	    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	</div>
</div>