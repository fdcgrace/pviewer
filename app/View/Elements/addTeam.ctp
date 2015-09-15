<div class="modal-header">
	<h4 class="modal-title" id="myModalLabel"><?php echo __('Add Team Leader'); ?></h4>
</div>

<div class="modal-body">
	<?php echo $this->Form->create('Member'); ?>
	<fieldset>
	<?php
		echo "<div class='form-group'>";
		echo $this->Form->input('team', array('label' => 'Name', 'class' => 'form-control', 'name' => 'team'));
		echo "</div>";
	?>
	</fieldset>
	<div class="buttons">
	<div class="fleft mar10"><input type="submit" value="Save" class="btn btn-primary" style="float:left" /></div>
	<div><button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button></div>
</div>