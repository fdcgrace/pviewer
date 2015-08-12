<div class="container-fluid">
	<h3>Project Detail</h3>
	<div class="row">
		<div class="col-md-8">
			<?php echo $this->Html->link(__('Project List'), array('controller' => 'Projects', 'action' => 'index'), array('class' => 'btn btn-primary')); ?>
			<?php echo $this->Html->link(__('Create New Issue'), array('action' => 'add', $p_id), array('class' => 'btn btn-success')); ?>
		</div>
		<div class="col-md-4">
			Legend: 
			<?php foreach ($legendColor as $key => $value): ?>
				<span class="label color-box" style="background-color:<?php echo $key;?>"  id="<?php echo $key;?>"><?php echo $value;?></span>
			<?php endforeach;?>
		</div>
	</div>	
	<hr>
	<div class="container-fluid">
		<div class="row">
			<table class="table table-striped">
				<thead>
					<tr>
						<th><?php echo $this->Paginator->sort('Project ID'); ?></th>
						<th><?php echo $this->Paginator->sort('Deadline'); ?></th>
						<th><?php echo $this->Paginator->sort('Issue Number'); ?></th>
						<!-- <th><?php //echo $this->Paginator->sort('Sub Task Description'); ?></th> -->
						<th><?php echo $this->Paginator->sort('Task Description'); ?></th>
						<th><?php echo $this->Paginator->sort('Assignee'); ?></th>
						<th><?php echo $this->Paginator->sort('Issue Link'); ?></th>
						<th><?php echo $this->Paginator->sort('Status'); ?></th>
						<th><?php echo $this->Paginator->sort('Created Date'); ?></th>
						<th><?php echo $this->Paginator->sort('Modified Date'); ?></th>
						<th class="actions"><?php echo __('Actions'); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($pdetails as $Pdetail): ?>
						<?php echo $this->Form->create('Pdetail'); ?>
						<tr style="background-color:<?php echo h($Pdetail['TblColor']['color']);?>">
							<td><?php echo h($Pdetail['Pdetail']['project_id']); ?></td>
							<td><?php echo h($Pdetail['Pdetail']['deadline']); ?></td>
							<td><?php echo h($Pdetail['Pdetail']['issue_no']); ?></td>
							<!-- <td><?php //echo h($Pdetail['Pdetail']['sub_task']); ?></td> -->
							<td><?php echo h($Pdetail['Pdetail']['task_description']); ?></td>
							<td>
								<?php echo $this->Form->input('member', array(
									'type'=>'select', 
									'label' => '', 
									'empty' => 'Please Select',
									'selected' => $Pdetail['Pdetail']['member']
									)
								); ?>
							</td>
							<td>
								<a href="<?php echo h($Pdetail['Pdetail']['issue_link']);?>" target="_blank"><?php echo h($Pdetail['Pdetail']['issue_link']);?></a>
							</td>

							<td><?php echo $this->Form->input('status', array(
								'type'=>'select', 
								'label' => '', 
								'empty' => 'Please Select',
								'default' => $Pdetail['Pdetail']['status'],
								'selected' => $Pdetail['Pdetail']['status'],
								'options' => array(
										'0' => 'Inactive',
										'1' => 'In Progress',
										'2' => 'Pending',
										'3' => 'For Confirmation',
										'4' => 'For Testing',
										'5' => 'Released',
										'6'	=> 'Closed'
										)
									)
								); ?>
							</td>
							<td><?php echo h($Pdetail['Pdetail']['created']); ?></td>
							<td><?php echo h($Pdetail['Pdetail']['modified']); ?></td>
							<td class="actions">
								<?php echo $this->Form->input('id', array('type' => 'hidden', 'value' => $Pdetail['Pdetail']['id']));?>
								<?php echo $this->Form->submit(__('Update Status'), array('class' => 'btn btn-primary btn-xs'),array('action' => 'index')); ?>
								<?php //echo $this->Html->link(__('View'), array('action' => 'view', $Pdetail['Pdetail']['id'])); ?>
								<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $Pdetail['Pdetail']['id']), array('class' => 'btn btn-primary btn-xs')); ?>
								<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $Pdetail['Pdetail']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $Pdetail['Pdetail']['id']), 'class' => 'btn btn-primary btn-xs')); ?>
							</td>
							<td>

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

<script>
$(document).ready(function(){

	$('.color-box').colpick({
		colorScheme:'dark',
		layout:'rgbhex',
		color:'ff8800',
		onSubmit:function(hsb,hex,rgb,el) {
			$(el).css('background-color', '#'+hex);
			$(el).colpickHide();

			var val = $(el).text();
			var bcolor = '#'+hex;
			$.ajax({
				type: "POST",
				url: "pdetails/",
				data: { 'changeColor' : val, 'color': bcolor},
				success: function (data) {
					location.reload();
				}
			});
	
		}
	});
	
});
</script>
