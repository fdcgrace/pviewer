<div class="container-fluid">
<legend><?php echo __('Add Project'); ?></legend>
	<div class="row">
		<div class="col-md-12">
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
				echo $this->Form->input('team_id', array('class' => 'form-control'));
				echo "</div>";
			?>
			</fieldset>
			<div class="submit" style="margin:0 0 20px; 0">
			    <input type="submit" value="Save" class="btn btn-primary" />
			    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			</div>
		</div>
		
	</div>
</div>