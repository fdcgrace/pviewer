
<?php 	

	$res = $this->Session->read('result');
	if (isset($res)) {
		if ($res == 'success') { ?>
			<div class="alert alert-success">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Success!</strong><?php echo $this->Session->read('message');?>
			</div>
<?php 	} else if ($res == 'warning') {?>
			<div class="alert alert-warning">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Error!</strong><?php echo $this->Session->read('message');?>
			</div>
<?php 	} unset($_SESSION['result']); } ?>

<?php 	if((null === $this->Session->read('team')) && (null === $this->Session->read('team')) ) {
			$team_session = "";
			$proj_session = "";
		} else {
			$team_session = $this->Session->read('team');
			$proj_session = $this->Session->read('project');
		} 
?>

<style>
	table > tr > td {
		padding: 0;
		border: 0;
		border-top: 0px;
		border-bottom: 0px;
		border-spacing: 0px;
	}
</style>

<script>
	$(function() {
		var team = "<?php echo $team_session;?>";
		var project = "<?php echo $proj_session;?>";
		// alert(team);
		// alert(project);
		sessionVal();
		checkTeam();
		checkProject();

		function sessionVal() {
			if(team != "" && project != "") {
				$("#team").val(team);
				$("#team_project").val(project);
			}
		}
	});
</script>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-8">
			<?php echo $this->Html->link(__('Project List'), array('controller' => 'Projects', 'action' => 'index'), array('class' => 'btn btn-primary')); ?>
			<?php echo $this->Html->link(__('Member List'), array('controller' => 'Members', 'action' => 'index'), array('class' => 'btn btn-info')); ?>
			<?php echo $this->Html->link(__('Team Leader List'), array('controller' => 'Teams', 'action' => 'view'), array('class' => 'btn btn-warning')); ?>
			<?php echo $this->Html->link(__('Add Team Leader'), '#', array('class' => 'btn btn-success', 'data-target' => '#add', 'data-toggle' => 'modal')); ?>
			<?php echo $this->Html->link(__('Save'), array('controller' => 'Teams', 'action' => 'save'), array('class' => 'btn btn-default')); ?>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-3">
			<select id="team" class="form-control" style="width:100%">
				<option value="">Please Select Team</option>
				<?php foreach ($team as $teams):?>
				<option value="<?php echo h($teams['Team']['id']);?>"><?php echo h($teams['Team']['team']);?></option>
				<?php endforeach;?>
			</select>
		</div>
		<div class="col-md-3">
			<select id="team_project" class="form-control" style="width:100%" disabled="disabled">
				<option value="">Please Select Project</option>
				<?php foreach ($pdetails as $pdetail):?>
				<option class="issue" id="<?php echo h($pdetail['Project']['team_id']);?>" value="<?php echo h($pdetail['Project']['id']);?>"><?php echo h($pdetail['Project']['p_name']);?></option>
				<?php endforeach;?>
			</select>
		</div>
	</div>
	<br><br>
	<div class="row">
		<div class="col-md-6">
			<div id="team_body" class="panel-group" role="tablist" aria-multiselectable="true">
				<!--append view file for team here-->
			</div>
		</div>
		<div class="col-md-6">
			<div id="project_body" class="panel-group" role="tablist" aria-multiselectable="true">
			<!--append view file for project here-->
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="add" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3>Add Team Leader</h3>
			</div>
			<div class="modal-body">
				<?php
					echo $this->Form->create('Team', array('url' => array('controller' => 'Teams', 'action' => 'add')));
					echo $this->Form->input('team', array('class' => 'form-control', 'label' => 'Team Name', 'placeholder' => 'Enter Name...', 'id' => 'team'));
				?>
			</div>
			<div class="modal-footer">
				<div class="btn-group">
					<?php
						echo $this->Form->submit('Add', array('class' => 'btn btn-primary'));
						$this->Form->end();
					?>
				</div>
			</div>
		</div>
	</div>
</div>
