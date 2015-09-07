<style>
	#addBtn {
		border-radius:50%;
		width:25px;
		height:25px;
	}
</style>
<section class="container-fluid" id="content">

	<div class="row mt">
		<h3> Project List <?php echo $this->Html->link('', array('controller' => 'projects', 'action' => 'add'), array('class' => 'glyphicon glyphicon-plus', 'data-toggle' => 'modal', 'data-target' => '#newProj', 'id' => 'addBtn')); ?> </h3>
		<hr>
		<div class="col-md-12">

			<div class="content-panel">
		<div data-example-id="simple-responsive-table" class="bs-example">
    <div class="table-responsive ">
  <table class="table table-striped table-advance table-hover">
   <thead>
    <tr>
     <th>Project ID</th>
     <th>Deadline</th>
     <th>Issue Number</th>
     <th>Task Description</th>
     <th>Assignee</th>
     <th>Issue Link</th>
     <th>Status</th>
     <th>Priority</th>
     <th>Progress</th>
     <th>Actions</th>
    </tr>
  </thead>
  <tbody>
   <tr>
    <td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td><td></td><td></td><td></td><td></td>
   </tr>
  </tbody>
  </table>
 </div>
</div>

				<table class="table table-striped table-advance table-hover table-responsive">
						<thead>
							<tr class="text-center">
								<th>Project Name</th>
								<th>Link</th>
								<th>Team Assigned</th>
								<th># of Task</th>
								<th>Created Date</th>
								<th>Modified Date</th>
								<th class="actions">Actions</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Applisquare</td>
								<td><a href="http://applisquare.fdc-inc.com/ad/index_ad_with_filtering.php?sid=e756f06691759ffd5ebed8f1bcb0ac80&ucd=XXX&carrier=4&ad_type=paid" target="_blank">http://applisquare.fdc-inc.com/ad/index_ad_with_filtering.php...</a></td>
								<td>Evan</td>
								<td>3</td>
								<td>2015-08-06</td>
								<td>2015-08-06</td>
								<td class="actions">
									<?php echo $this->Html->link(__(''), array('controller' => 'pdetails', 'action' => 'index', 1), array('class' => 'glyphicon glyphicon-eye-open')); ?>
									<?php echo $this->Html->link(__(''), array('action' => 'edit', 1), array('data-toggle' => 'modal', 'data-target' => '#editProj', 'class' => 'glyphicon glyphicon-pencil')); ?>
									<?php echo $this->Form->postLink(__(''), array('action' => 'delete', 1), array('confirm' => __('Are you sure you want to delete # %s?', 1), 'class' => 'glyphicon glyphicon-trash')); ?>
								</td>
							</tr>
							<tr>
								<td>Native Camp</td>
								<td></td>
								<td>Rich</td>
								<td>5</td>
								<td>0000-00-00</td>
								<td>0000-00-00</td>
								<td class="actions">
									<?php echo $this->Html->link(__(''), array('controller' => 'pdetails', 'action' => 'index', 1), array('class' => 'glyphicon glyphicon-eye-open')); ?>
									<?php echo $this->Html->link(__(''), array('action' => 'edit', 1), array('data-toggle' => 'modal', 'data-target' => '#editProj', 'class' => 'glyphicon glyphicon-pencil')); ?>
									<?php echo $this->Form->postLink(__(''), array('action' => 'delete', 1), array('confirm' => __('Are you sure you want to delete # %s?', 1), 'class' => 'glyphicon glyphicon-trash')); ?>
								</td>
							</tr>
							<tr>
								<td>L-Charge</td>
								<td><a href="http://l-charge.fdc-inc.com/index_smt_ca.php?s=421" target="_blank">http://l-charge.fdc-inc.com/index_smt_ca.php?s=421</a></td>
								<td>Evan</td>
								<td>4</td>
								<td>0000-00-00</td>
								<td>0000-00-00</td>
								<td class="actions">
									<?php echo $this->Html->link(__(''), array('controller' => 'pdetails', 'action' => 'index', 1), array('class' => 'glyphicon glyphicon-eye-open')); ?>
									<?php echo $this->Html->link(__(''), array('action' => 'edit', 1), array('data-toggle' => 'modal', 'data-target' => '#editProj', 'class' => 'glyphicon glyphicon-pencil')); ?>
									<?php echo $this->Form->postLink(__(''), array('action' => 'delete', 1), array('confirm' => __('Are you sure you want to delete # %s?', 1), 'class' => 'glyphicon glyphicon-trash')); ?>
								</td>
							</tr>
						</tbody>
					</table>
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
