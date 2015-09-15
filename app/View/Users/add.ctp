<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Add User'); ?></legend>
	<?php
		echo "<div class='form-group'>";
		echo $this->Form->input('user');
		echo "</div>
			 <div class='form-group'>";
		echo $this->Form->input('password');
		echo "</div>
			 <div class='form-group'>";
		echo $this->Form->input('role', array(
				'class' => 'form-control',
				'type'=>'select', 
				'label' => 'Role',
				'options' => $role
					)
				);
		echo "</div>";
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
