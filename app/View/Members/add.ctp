<div class="container-fluid form">
	<h3>Add Member</h3>
	<div class="form-group">
	<?php
		echo $this->Form->create('Member', array('type' => 'post', 'url' => array('controller' => 'Members', 'action' => 'add')));
		echo $this->Form->input('member', array('type' => 'text','class' => 'form-control', 'label' => false));
		echo $this->Form->input('team_id', array('type' => 'hidden', 'value' => $t_id));
	?>
	<br>
		<div class="submit">
		    <input type="submit" value="Save" class="btn btn-primary"/>
		    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		</div>
	</div>
</div>