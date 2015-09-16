<?php  
	echo $this->Html->script(array('definedjs')); 
?>
<div class="container-fluid">
	<!-- <h3>Member List</h3> -->
	<h3> Member List</h3><hr>
	<div class="container-fluid alignMargin">
	<?php echo $this->Html->link('Add New Member', array('controller' => 'members', 'action' => 'add'), array('class' => 'glyphicon-plus glyphicon btn btn-success nfont', 'data-toggle' => 'modal', 'data-target' => '#addForm', 'id' => 'addBtn')); ?>
	</div> 
	<div class="col-md-12">
	<div class="col-md-6">
		<div class="row">
			<div data-example-id="simple-responsive-table" class="bs-example">
    			<div class="table-responsive">
					<table class="table table-striped members">
						<thead>
							<th><?php echo $this->Paginator->sort('Member Name'); ?></th>
							<th><?php echo $this->Paginator->sort('Team Name'); ?></th>
							<th><?php echo $this->Paginator->sort('Created'); ?></th>
							<th><?php echo $this->Paginator->sort('Modified'); ?></th>
							<th><?php echo $this->Paginator->sort('Status'); ?></th>
							<th class="actions"><?php echo __('Actions'); ?></th>
						</thead>
						<tbody>
							<?php foreach ($members as $member): ?>
								<tr>
									<td><?php echo h($member['Member']['member']); ?></td>
									<td><?php echo h($member['Team']['team']); ?></td>
									<td><?php echo h($member['Member']['created']); ?></td>
									<td><?php echo h($member['Member']['modified']); ?></td>
									<td><?php echo $member['Member']['del_flg'] == 0 ? $deactivate : $activate; ?></td>
									<td class="actions">
										<?php echo $this->Html->link(__(''), '#', array('label' => false, 'value' => $member['Member']['id'], 'class' => 'btn glyphicon glyphicon-eye-open view', 'flag' => $member['Member']['del_flg'])); ?>
										<?php echo $this->Html->link(__(''), array('action' => 'edit', $member['Member']['id']), array('data-toggle' => 'modal', 'data-target' => '#editForm', 'class' => 'glyphicon glyphicon-pencil', 'id' =>'formEdit')); ?>
										<?php if ($member['Member']['del_flg']) :?>
										<?php echo $this->Form->postLink(__(''), array('action' => 'deactivate', $member['Member']['id']), array('label' => false, 'class' => 'btn glyphicon glyphicon-trash', 'confirm' => __('Are you sure you want to deactivate # %s?', $member['Member']['id']))); ?>
										<?php else :?>
										<?php echo $this->Form->postLink(__(''), array('action' => 'activate', $member['Member']['id']), array('label' => false, 'class' => 'btn glyphicon glyphicon-user', 'confirm' => __('Are you sure you want to activate # %s?', $member['Member']['id']))); ?>
										<?php endif;?>
									</td>
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
	<div class=" row paging btn-group pagination-margin alignMargin">
	<?php
		echo $this->Paginator->prev('< ' . __(''), array('tag' => false, 'class' => 'btn btn-sm btn-primary'), null, array('tag' => false, 'class' => 'btn btn-sm btn-primary prev disabled'));
		echo $this->Paginator->numbers(array('separator' => '', 'class' => 'btn btn-sm btn-default'));
		echo $this->Paginator->next(__('') . ' >', array('tag' => false, 'class' => 'btn btn-sm btn-primary'), null, array('tag' => false, 'class' => 'btn btn-sm btn-primary next disabled'));
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