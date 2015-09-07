<?php $team = $content['team']; ?>
<div class="modal-body">
    <?php
    	//var_dump($team);
		/* create form with proper enctype */
		//echo $this->Form->create('team', array('action' => 'edit'));
		echo $this->Form->create('Team');
		echo $this->Form->hidden('id', array('type' => 'hidden', 'value' => $team['Team']['id'], 'class' => 'form-control', 'name' => 'id'));
		echo "<div class='form-group'>";
		echo $this->Form->input('team', array('type' => 'text', 'value' => $team['Team']['team'], 'class' => 'form-control'));
		echo "</div>";
		echo "<div class='form-group'>";
		echo $this->Form->input('del_flg', array(
							'type'=>'select', 
							'label' => 'Status ',
							'class' => 'form-control',
							'selected' => $team['Team']['del_flg'],
							'default' => $team['Team']['del_flg'],
							'options'=> $getStatus
							)
						);
		echo "</div>"; 
		?>
		<div class="buttons">
		<div class="fleft mar10"><input type="submit" value="Save" class="btn btn-primary" style="float:left" /></div>
		<div><button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button></div>
	</div>
</div>
