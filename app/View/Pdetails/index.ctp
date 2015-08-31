<?php 	
	$res = $this->Session->read('result');
	if (isset($res)) {
		if ($res == 'success') { ?>
			<div class="alert alert-success">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Success!</strong><?php echo $this->Session->read('message');?>
			</div>
<?php 	} else if ($res == 'warning') { ?>
			<div class="alert alert-warning">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Error!</strong><?php echo $this->Session->read('message');?>
			</div>
<?php 	}   } if(isset($_SESSION['result'])) { unset($_SESSION['result']); }?>

<div class="container-fluid">
	<h3>Project Detail</h3>
	<div class="row">
		<div class="col-md-8">
			<?php echo $this->Html->link(__('Project List'), array('controller' => 'Projects', 'action' => 'index'), array('class' => 'btn btn-primary')); ?>
			<?php echo $this->Html->link(__('Create New Issue'), array('action' => 'add', $p_id), array('class' => 'btn btn-success', 'data-toggle' => 'modal', 'data-target' => '#addForm')); ?>
			<?php echo $this->Html->link(__('Add Member'), array('controller' => 'Members', 'action' => 'add', $t_id), array('class' => 'btn btn-default', 'data-toggle' => 'modal', 'data-target' => '#addMember')); ?>
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
						<th><?php echo $this->Paginator->sort('Date assigned'); ?></th>
						<th><?php echo $this->Paginator->sort('Issue Number'); ?></th>
						<th><?php echo $this->Paginator->sort('Sub Task Description'); ?></th>
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
					<?php foreach ($pdetails as $Pdetail):?>
						<?php $count = 0;?>
						<?php $count++;?>
						<?php echo $this->Form->create('Pdetail'); ?>
						<tr class="pdetail" style="background-color:<?php echo h($Pdetail['TblColor']['color']);?>" state="hover" value="<?php echo $Pdetail['Pdetail']['id'];?>" data-title="Comment"data-html=true data-placement="bottom" data-toggle="popover" data-content="<a class='comment'><?php echo $Pdetail['Pdetail']['comment'];?></a>">
							<td><?php echo h($Pdetail['Pdetail']['project_id']); ?></td>
							<td><?php echo h($Pdetail['Pdetail']['deadline']); ?></td>
							<td><?php echo h($Pdetail['Pdetail']['issue_no']); ?></td>
							<td><?php echo h($Pdetail['Pdetail']['sub_task']); ?></td>
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
								<?php echo $this->Form->submit(__('Update Status'), array('action' => 'index')); ?>
								<?php //echo $this->Html->link(__('View'), array('action' => 'view', $Pdetail['Pdetail']['id'])); ?>
								<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $Pdetail['Pdetail']['id']), array('data-toggle' => 'modal', 'data-target' => '#editForm')); ?>
								<?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $Pdetail['Pdetail']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $Pdetail['Pdetail']['id']))); ?>

								<?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $Pdetail['Pdetail']['id'], $Pdetail['Pdetail']['project_id']), array('confirm' => __('Are you sure you want to delete this Project?'))); ?>

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
<!--addForm button -->
<div class="modal fade" id="addForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false" >
	<div class="modal-dialog">
	    <div class="modal-content">
	    </div>
	</div>
</div>
<!--end addForm button -->

<!--editForm button -->
<div class="modal fade" id="editForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false" >
	<div class="modal-dialog">
	    <div class="modal-content">
	    </div>
	</div>
</div>
<!--end editForm button -->

<div class="modal fade" id="addMember" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false" >
	<div class="modal-dialog">
		<div class="modal-content">
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

	$('[data-toggle="popover"]').popover({
		trigger: 'manual'
	}).on('mouseenter', function() {
		if($(this).attr('state') !== 'pinned') {
			$(this).popover('show');
		}
	}).on('mouseleave', function() {
		if($(this).attr('state') === 'hover') {
			$(this).popover('hide');
		}
	}).on('dblclick', function() {
		if($(this).attr('state') === 'hover') {
			$(this).popover('show');
			$(this).attr('state', 'pinned');
		} else {
			$(this).attr('state', 'hover');
			$(this).popover('hide');
		}
		$('[data-toggle="popover"]').not(this).popover('hide');
		$('[data-toggle="popover"]').not(this).attr('state', 'hover');
		editComment();
	});

	function editComment(callback) {
		$("a.comment").on('dblclick', function() {
			console.log("called");
			var form = "<input id='comment' class='comment form-control' type='text' name='comment' value='"+$(this).text()+
					   "'></input><button class='glyphicon glyphicon-ok'/></button>";
			$(".popover-content").append(form);
			$(this).remove();
			update();
		});
	}

	function update(callback) {
		$(".glyphicon-ok").on('click', function() {
			var text = $("input.comment").val();
			$('[data-toggle="popover"]').each(function() {
				if($(this).attr('state') === 'pinned') {
					// alert(text);
					var id = $(this).attr('value');
					$.ajax({
						url: "/pviewer/pdetails/update/",
						type: 'POST',
						data: {'comment': text, 'id': id},
						success: function(data) {
						},
						error: function(data) {
							alert('fail');
						}
					});
				}
				$(this).attr('data-content', '<a class="comment">'+text+'</a>');
				$(this).attr('state', 'hover');
				$(this).popover('hide');
			});
		});
	}
	
	$('body').on('click', function() {
		$('[data-toggle="popover"]').each(function () {
			if($(this).attr('state') === 'pinned') {
				$(this).popover('hide');
				$(this).attr('state', 'hover');
			}
	    });
	});
});
</script>

