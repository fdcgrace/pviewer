<?php 
	$members = $content['members'];
	$team = $content['team'];
?>
<div class="modal-body">
    <?php
		echo $this->Form->create('Member');
		echo $this->Form->input('team_id', array(
							'type'=>'select', 
							'label' => 'Team',
							'class' => 'form-control',
							'selected' => $members['Member']['team_id'],
							'default' => $members['Member']['team_id'],
							'options'=> $team
							)
						);
		echo $this->Form->hidden('id', array('type' => 'hidden', 'value' => $members['Member']['id'], 'class' => 'form-control', 'name' => 'member_id'));
		echo "<div class='form-group'>";
		echo $this->Form->input('member', array('type' => 'text', 'value' => $members['Member']['member'], 'class' => 'form-control'));
		echo "</div>";
		echo "<div class='form-group'>";
		echo $this->Form->input('del_flg', array(
							'type'=>'select', 
							'label' => 'Status ',
							'class' => 'form-control',
							'selected' => $members['Member']['del_flg'],
							'default' => $members['Member']['del_flg'],
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

<script type="text/javascript">
	$(document).ready(function(){
		$('body').on('hidden.bs.modal', '.modal', function () {
			$(this).removeData('bs.modal');
		});
	});
</script>
