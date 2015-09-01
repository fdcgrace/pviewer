<div class="container-fluid">
	<h3>Project List</h3>
	<div class="row">
		<div class="col-md-1">
			<div class="list-group">
				<?php echo $this->Html->link(__('New Project'), array('action' => 'add'), array('class' => 'btn btn-success', 'data-toggle' => 'modal', 'data-target' => '#newProj')); ?>
			</div>
		</div>

		<div class="col-md-11">
			<div class="table-responsive">
				<table class="table table-hover">
					<thead>
						<tr>
							<th><?php echo $this->Paginator->sort('Project Name'); ?></th>
							<th><?php echo $this->Paginator->sort('Link'); ?></th>
							<th><?php echo $this->Paginator->sort('Team Assigned'); ?></th>
							<th><?php echo $this->Paginator->sort('Number of Task'); ?></th>
							<th><?php echo $this->Paginator->sort('Created Date'); ?></th>
							<th><?php echo $this->Paginator->sort('Modified Date'); ?></th>
							<th class="actions"><?php echo __('Actions'); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($projects as $project): ?>
							<tr>
								<td><?php echo h($project['Project']['p_name']); ?></td>
								<td><a href="<?php echo h($project['Project']['link']); ?>" target="_blank"><?php echo h($project['Project']['link']); ?></a></td>
								<td><?php echo h($project['Leader']['team']); ?></td>
								<td><?php echo h($project[0]['total_num_task']); ?></td>
								<td><?php echo h($project['Project']['created']); ?></td>
								<td><?php echo h($project['Project']['modified']); ?></td>
								<td class="actions">

									<?php echo $this->Html->link(__('View Issue'), array('controller' => 'pdetails', 'action' => 'index', $project['Project']['id'])); ?>
									<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $project['Project']['id']), array('data-toggle' => 'modal', 'data-target' => '#editProj')); ?>
									<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $project['Project']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $project['Project']['id']))); ?>

								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<p>
				<?php
					echo $this->Paginator->counter(array(
						'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
					));
					?>	
			</p>
			<div class="paging">
				<?php
					echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
					echo $this->Paginator->numbers(array('separator' => ''));
					echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
				?>
			</div>
		</div>
	</div>
</div>

<!--new proj button -->
<div class="modal fade" id="newProj" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false" >
		<div class="modal-dialog">
		    <div class="modal-content">
		    </div>
	</div>
</div>
<!--end new proj button -->

<!--edit proj button -->
<div class="modal fade" id="editProj" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false" >
		<div class="modal-dialog">
		    <div class="modal-content">
		    </div>
	</div>
</div>
<!--end edit proj button -->
