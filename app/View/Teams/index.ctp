<div class="container-fluid">
<?php echo $this->Html->link(__('Project List'), array('controller' => 'Projects', 'action' => 'index'), array('class' => 'btn btn-primary')); ?>
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
				      		<?php echo $teams[0];?>
							</a>
			      		</h4>
			    	</div>
		    		<div id="<?php echo $counter;?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
		      			<div class="panel-body">
					      	<table class="table table-hover">
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
					      	<?php foreach ($teams as $key2 => $val): ?>
					      			<?php if ($key2 != 0 ):?>
										<tbody>
											<tr>
												<td><?php echo h($val['Project']['p_name']); ?></td>
												<td><a href="<?php echo h($teams[1]['Project']['link']); ?>" target="_blank"><?php echo h($val['Project']['link']); ?></a></td>
												<td><?php echo h($val['Team']['team']); ?></td>
												<td><?php echo h($val['Project']['no_of_task']); ?></td>
												<td><?php echo h($val['Project']['created']); ?></td>
												<td><?php echo h($val['Project']['modified']); ?></td>
												<td class="actions">
													<?php echo $this->Html->link(__('View Issue'), array('controller' => 'pdetails', 'action' => 'index', $val['Project']['id'])); ?>
													<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $val['Project']['id'])); ?>
													<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $val['Project']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $val['Project']['id']))); ?>
												</td>
											</tr>
										</tbody>
									<?php endif;?>
								
							<?php endforeach; ?>
							</table>
				      	</div>
				    </div>
			  	</div>
			</div>
	<?php endforeach; ?>
	</div>
</div>