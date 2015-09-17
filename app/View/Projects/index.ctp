<section class="container-fluid flip-scroll" id="content">
	<div class="row mt">
		<h3>Project List</h3>
		<hr>
		<div class="marginButton nfont alignMargin"><?php echo $this->Html->link('Create New Project', array('controller' => 'projects', 'action' => 'add'), array('data-toggle' => 'modal', 'data-target' => '#newProj', 'id' => 'addBtn', 'class' => 'glyphicon-plus glyphicon btn btn-success nfont')); 
			?>
		</div>

		<div class="col-md-12">
			<div class="content-panel">
				<div data-example-id="simple-responsive-table" class="bs-example">
					<div class="table-responsive ">
						<table class="table table-striped table-advance table-hover">
							<thead>
								<tr>
								<th><?php echo $this->Paginator->sort('Project Name'); ?></th>
								<th><?php echo $this->Paginator->sort('Link'); ?></th>
								<th><?php echo $this->Paginator->sort('Team Assigned'); ?></th>
								<!-- <th><?php //echo $this->Paginator->sort('Number of Task'); ?></th> -->
								<th><?php echo $this->Paginator->sort('Created Date'); ?></th>
								<th class="actions"><?php echo __('Actions'); ?></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($projects as $project): ?>
								<tr>
									<td><?php echo h($project['Project']['p_name']); ?></td>
									<td><a href="<?php echo h($project['Project']['link']); ?>" target="_blank"><?php echo h($project['Project']['link']); ?></a></td>
									<td><?php echo h($project['Leader']['team']); ?></td>
									<!-- <td><?php //echo h($project[0]['total_num_task']); ?></td> -->
									<td><?php echo h($project['Project']['created']); ?></td>
									<td class="actions">

										<?php echo $this->Html->link(__(''), array('controller' => 'pdetails', 'action' => 'index', $project['Project']['id']), array('class' => 'btn glyphicon glyphicon-eye-open view')); ?>

										<?php echo $this->Html->link(__(''), array('action' => 'edit', $project['Project']['id']), array('data-toggle' => 'modal', 'data-target' => '#editProj', 'class' => 'glyphicon glyphicon-pencil', 'id' =>'formEdit')); ?>

										<?php echo $this->Form->postLink(__(''), array('action' => 'delete', $project['Project']['id']), array('label' => false, 'class' => 'btn glyphicon glyphicon-trash', 'confirm' => __('Are you sure you want to delete # %s?', $project['Project']['id']))); ?>

									</td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>

			<br> <br>
			<div class="row mt paging btn-group" style="margin-left:47%;margin-right:40%;">
				<?php echo $this->Html->link(__('<'), '#', array('class' => 'btn btn-sm btn-default'));?>
				<?php echo $this->Html->link(__('>'), '#', array('class' => 'btn btn-sm btn-default'));?>

			</div>
		</div>
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
</section>

<!--new proj modal -->
<div class="modal fade" id="newProj" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false" >
	<div class="modal-dialog">
	    <div class="modal-content">
	    </div>
	</div>
</div>
<!--end new proj modal -->

<!--edit proj modal -->
<div class="modal fade" id="editProj" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false" >
	<div class="modal-dialog">
	    <div class="modal-content">
	    </div>
	</div>
</div>
<!--end edit proj modal -->

