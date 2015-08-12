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
<?php 	}   } unset($_SESSION['result']);?>


<div class="container-fluid">
	<div class="row">
		<div class="col-md-8">
			<?php echo $this->Html->link(__('Project List'), array('controller' => 'Projects', 'action' => 'index'), array('class' => 'btn btn-primary')); ?>
			<a class="btn btn-success" data-toggle="modal" data-target="#add">Add Team Leader</a>
		</div>
	</div>
	<hr>
	<div class="row">
	<?php $counter = 0; ?>
	<?php foreach ($team as $key => $teams): ?>
		<?php $counter++; ?>
			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
			  	<div class="panel panel-default">
			    	<div class="panel-heading" role="tab" id="headingOne">
			      		<h4 class="panel-title">
			        		<a role="button" data-toggle="collapse" data-parent="#accordion" href="#<?php echo $counter;?>" aria-expanded="true" aria-controls="collapseOne">
				      		<?php echo $teams['Team']['team'];?>
							</a>
			      		</h4>
			    	</div>
		    		<div id="<?php echo $counter;?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
		      			<div class="panel-body">
					      	<table class="table table-hover">
					      	<?php if($teams['Project']['p_name']): ?>
							<thead>
								<tr>
									<th><?php echo $this->Paginator->sort('Project Name'); ?></th>
									<th><?php echo $this->Paginator->sort('Link'); ?></th>
									<th><?php echo $this->Paginator->sort('Team Assigned'); ?></th>
									<th><?php echo $this->Paginator->sort('Number of Task'); ?></th>
									<th><?php echo $this->Paginator->sort('Created Date'); ?></th>
									<th><?php echo $this->Paginator->sort('Modifiedd Date'); ?></th>
									<th class="actions"><?php echo __('Actions'); ?></th>
								</tr>
							</thead>
					      	<?php //foreach ($teams as $key2 => $val): ?>
					      			<?php //if ($key2 != 0 ):?>
					      			
										<tbody>
											<tr>
												<td><?php echo h($teams['Project']['p_name']); ?></td>
												<td><a href="<?php echo h($teams['Project']['link']); ?>" target="_blank"><?php echo h($teams['Project']['link']); ?></a></td>
												<td><?php echo h($teams['Team']['team']); ?></td>
												<td><?php echo h($teams[0]['total_num_task']); ?></td>
												<td><?php echo h($teams['Project']['created']); ?></td>
												<td><?php echo h($teams['Project']['modified']); ?></td>
												<td class="actions">
													<?php echo $this->Html->link(__('View Issue'), array('controller' => 'pdetails', 'action' => 'index', $teams['Project']['id'])); ?>
													<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $teams['Project']['id'])); ?>
													<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $teams['Project']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $teams['Project']['id']))); ?>
												</td>
											</tr>
										</tbody>
									<?php else:?>
										<tbody>
											<td>No Issue</td>
										</tbody>
									<?php endif;?>
							<?php// endforeach; ?>
							</table>
				      	</div>
				    </div>
			  	</div>
			</div>
	<?php endforeach; ?>
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