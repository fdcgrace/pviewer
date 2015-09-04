<section class="container-fluid" id="content">
	<h3>Member List</h3>
	<hr>
	<div class="row mt">
		<div class="col-md-6">
			<div class="row mt">
				<div class="content-panel">
					<table class="table table-striped table-advance table-hover table-responsive">
						<thead>
							<th>Member Name</th>
							<th>Team Name</th>
							<th class="actions">Actions</th>
						</thead>
						<tbody>
							<tr>
								<td>Grace</td>
								<td>Evan</td>
								<td class="actions">
									<?php echo $this->Html->link(__(''), '#', array('label' => false, 'value' => 1, 'class' => 'btn glyphicon glyphicon-eye-open view', 'flag' => 1)); ?>
									<?php echo $this->Html->link(__(''), array('action' => 'edit', 1), array('data-toggle' => 'modal', 'data-target' => '#', 'label' => false, 'class' => 'btn glyphicon glyphicon-pencil', 'flag' => 1)); ?>
									<?php echo $this->Form->postLink(__(''), array('action' => 'deactivate', 1), array('label' => false, 'class' => 'btn glyphicon glyphicon-trash', 'confirm' => __('Are you sure you want to deactivate # %s?', 1))); ?>
								</td>
							</tr>
							<tr>
								<td>Kate</td>
								<td>Evan</td>
								<td class="actions">
									<?php echo $this->Html->link(__(''), '#', array('label' => false, 'value' => 1, 'class' => 'btn glyphicon glyphicon-eye-open view', 'flag' => 1)); ?>
									<?php echo $this->Html->link(__(''), array('action' => 'edit', 1), array('data-toggle' => 'modal', 'data-target' => '#', 'label' => false, 'class' => 'btn glyphicon glyphicon-pencil', 'flag' => 1)); ?>
									<?php echo $this->Form->postLink(__(''), array('action' => 'deactivate', 1), array('label' => false, 'class' => 'btn glyphicon glyphicon-trash', 'confirm' => __('Are you sure you want to deactivate # %s?', 1))); ?>
								</td>
							</tr>
							<tr>
								<td>Sharon</td>
								<td>Evan</td>
								<td class="actions">
									<?php echo $this->Html->link(__(''), '#', array('label' => false, 'value' => 1, 'class' => 'btn glyphicon glyphicon-eye-open view', 'flag' => 1)); ?>
									<?php echo $this->Html->link(__(''), array('action' => 'edit', 1), array('data-toggle' => 'modal', 'data-target' => '#', 'label' => false, 'class' => 'btn glyphicon glyphicon-pencil', 'flag' => 1)); ?>
									<?php echo $this->Form->postLink(__(''), array('action' => 'deactivate', 1), array('label' => false, 'class' => 'btn glyphicon glyphicon-trash', 'confirm' => __('Are you sure you want to deactivate # %s?', 1))); ?>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="row mt paging btn-group">
			<?php
				echo $this->Html->link('< ', '', array('class' => 'btn btn-sm btn-default'));
				echo $this->Html->link(' >', '', array('class' => 'btn btn-sm btn-default'));
			?>
			</div>
		</div>
		<div class="col-md-3">
			<div id="pdfRenderer" class="panel panel-default" style="height:600px;width:600px;background-color:#E6E6E6;">
			</div>
		</div>
	</div>
</section>