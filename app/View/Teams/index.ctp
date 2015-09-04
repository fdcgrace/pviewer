<section class="container-fluid" id="content">
	<h3>Team Leader List</h3>
	<hr>
	<div class="row mt">
		<div class="col-md-6">
			<div class="row mt">
				<div class="content-panel">
					<table class="table table-striped table-advance table-hover table-responsive">
						<thead>
							<th>Team Name</th>
							<th>Status</th>
							<th class="actions">Actions</th>
						</thead>
						<tbody>
							<tr>
								<td>Evan</td>
								<td>Active</td>
								<td class="actions">
									<?php echo $this->Html->link(__(''), array('#'), array('label' => false, 'class' => 'btn glyphicon glyphicon-eye-open view', 'flag' => 1)); ?>
									<?php echo $this->Html->link(__(''), array('action' => 'edit', 1), array('data-toggle' => 'modal', 'data-target' => '#', 'label' => false, 'class' => 'btn glyphicon glyphicon-pencil', 'flag' => 1)); ?>
									<?php echo $this->Form->postLink(__(''), array('action' => 'deactivate', 1), array('label' => false, 'class' => 'btn glyphicon glyphicon-trash', 'confirm' => __('Are you sure you want to deactivate # %s?', 1))); ?>
							</tr>
							<tr>
								<td>Rich</td>
								<td>Active</td>
								<td class="actions">
									<?php echo $this->Html->link(__(''), array('#'), array('label' => false, 'class' => 'btn glyphicon glyphicon-eye-open view', 'flag' => 1)); ?>
									<?php echo $this->Html->link(__(''), array('action' => 'edit', 1), array('data-toggle' => 'modal', 'data-target' => '#', 'label' => false, 'class' => 'btn glyphicon glyphicon-pencil', 'flag' => 1)); ?>
									<?php echo $this->Form->postLink(__(''), array('action' => 'deactivate', 1), array('label' => false, 'class' => 'btn glyphicon glyphicon-trash', 'confirm' => __('Are you sure you want to deactivate # %s?', 1))); ?>
							</tr>
							<tr>
								<td>Yongbo</td>
								<td>Active</td>
								<td class="actions">
									<?php echo $this->Html->link(__(''), array('#'), array('label' => false, 'class' => 'btn glyphicon glyphicon-eye-open view', 'flag' => 1)); ?>
									<?php echo $this->Html->link(__(''), array('action' => 'edit', 1), array('data-toggle' => 'modal', 'data-target' => '#', 'label' => false, 'class' => 'btn glyphicon glyphicon-pencil', 'flag' => 1)); ?>
									<?php echo $this->Form->postLink(__(''), array('action' => 'deactivate', 1), array('label' => false, 'class' => 'btn glyphicon glyphicon-trash', 'confirm' => __('Are you sure you want to deactivate # %s?', 1))); ?>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<br>
			<div class=" row paging btn-group">
			<?php
				echo $this->Html->link('< ', '', array('class' => 'btn btn-sm btn-default'));
				echo $this->Html->link(' >', '', array('class' => 'btn btn-sm btn-default'));
			?>
			</div>
		</div>
		<div class="col-md-6">
			<div id="pdfRenderer" class="panel panel-default" style="height:600px;width:600px;background-color:#E6E6E6;">
			</div>
		</div>
	</div>
</section>