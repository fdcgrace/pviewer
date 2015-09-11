<?php 
	echo $this->Html->script(array('definedjs'));
?>
<div class="container-fluid">
	<!-- <h3>Team Leader List</h3> -->
	<h3> Team Leader List <?php echo $this->Html->link('', array('controller' => 'teams', 'action' => 'add'), array('class' => 'glyphicon glyphicon-plus', 'data-toggle' => 'modal', 'data-target' => '#addForm', 'id' => 'addBtn')); ?> </h3>
	<div class="col-md-12">
		<div class="col-md-6">
			<div class="row">
				<div data-example-id="simple-responsive-table" class="bs-example">
    				<div class="table-responsive">
						<table class="table table-striped teams">
							<thead>
								<th><?php echo $this->Paginator->sort('Team Name'); ?></th>
								<th><?php echo $this->Paginator->sort('Created'); ?></th>
								<th><?php echo $this->Paginator->sort('Modified'); ?></th>
								<th><?php echo $this->Paginator->sort('Status'); ?></th>
								<th class="actions"><?php echo __('Actions'); ?></th>
							</thead>
							<tbody>
								<?php foreach ($teams as $team): ?>
									<tr>
										<td><?php echo h($team['Team']['team']); ?></td>
										<td><?php echo h($team['Team']['created']); ?></td>
										<td><?php echo h($team['Team']['modified']); ?></td>
										<td><?php echo $team['Team']['del_flg'] == 0 ? $deactivate : $activate; ?></td>
										<td class="actions">
											<?php echo $this->Html->link(__(''), array('#'), array('label' => false, 'class' => 'btn glyphicon glyphicon-eye-open view', 'flag' => $team['Team']['del_flg'])); ?>
											<?php echo $this->Html->link(__(''), array('action' => 'edit', $team['Team']['id']), array('data-toggle' => 'modal', 'data-target' => '#editForm', 'class' => 'glyphicon glyphicon-pencil', 'id' =>'formEdit')); ?>

											<?php //echo $this->Html->link(__(''), array('action' => 'edit', $team['Team']['id']), array('data-toggle' => 'modal', 'data-target' => '#', 'label' => false, 'class' => 'btn glyphicon glyphicon-pencil', 'flag' => $team['Team']['del_flg'])); ?>
											<?php if ($team['Team']['del_flg']) :?>
											<?php echo $this->Form->postLink(__(''), array('action' => 'deactivate', $team['Team']['id']), array('label' => false, 'class' => 'btn glyphicon glyphicon-trash', 'confirm' => __('Are you sure you want to deactivate # %s?', $team['Team']['id']))); ?>
											<?php else :?>
											<?php echo $this->Form->postLink(__(''), array('action' => 'activate', $team['Team']['id']), array('label' => false, 'class' => 'btn glyphicon glyphicon-user', 'confirm' => __('Are you sure you want to activate # %s?', $team['Team']['id']))); ?>
											<?php endif;?>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div id="pdfRenderer" class="panel panel-default mini-layout">
			</div> 
		</div>
	</div>
	<div class=" row paging btn-group pagination-margin">
	<?php
		echo $this->Paginator->prev('< ' . __(''), array('tag' => false, 'class' => 'btn-orange btn btn-sm btn-primary'), null, array('tag' => false, 'class' => 'btn-orange btn btn-sm btn-primary prev disabled'));
		echo $this->Paginator->numbers(array('separator' => '', 'class' => 'forange btn btn-sm btn-default'));
		echo $this->Paginator->next(__('') . ' >', array('tag' => false, 'class' => 'btn-orange btn btn-sm btn-primary'), null, array('tag' => false, 'class' => 'btn btn-sm btn-primary next disabled'));
	?>
	</div>
</div>

<!--editForm button -->
<div class="modal fade" id="editForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false" >
	<div class="modal-dialog">
	    <div class="modal-content">
	    </div>
	</div>
</div>
<!--end editForm button -->

<!--addForm button -->
<div class="modal fade" id="addForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false" >
	<div class="modal-dialog">
	    <div class="modal-content">
	    </div>
	</div>
</div>
<!--end addForm button -->