<section class="container-fluid" id="content">
	<h3>Issue Assignment</h3>
	<hr>
	<div class="row mt">
		<div class="col-md-6">
			<select id="team" class="form-control" style="width:100%">
				<option value="">Please Select Team</option>
			</select>
		</div>
		<div class="col-md-6">
			<select id="team_project" class="form-control" style="width:100%" disabled="disabled">
				<option value="">Please Select Project</option>
			</select>
		</div>
	</div>
	<br><br>
	<div class="row mt">
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
	<div class="row mt text-center">
		<span><?php echo $this->Html->link(__('Save'), array('controller' => 'Teams', 'action' => 'save'), array('class' => 'btn btn-default')); ?></span>
	</div>
</section>
