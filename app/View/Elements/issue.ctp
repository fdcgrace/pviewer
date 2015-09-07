<table class="table">
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
	<?php
		$selectedStatus = array();
		$tempar = array();
		$temp2 = array();
		$countArr = count($pdetails);
		$statusPdetail = $break_row = "";
		foreach ($pdetails as $key=>$Pdetail):
			if($key === 0)
				$tempar[] = $Pdetail['Pdetail']['status'];
				$temp2[] = prev($tempar);

			if($key+1 != $countArr)
				$break_row =  $pdetails[$key+1]['Pdetail']['status'];
			if($Pdetail['Pdetail']['status'] != prev($tempar))
				$statusPdetail = $Pdetail['Pdetail']['status'];
			$selectedStatus[] = $statusPdetail;
			echo $this->Form->create('Pdetail');
			$detId = $Pdetail['Pdetail']['id'];
	?>
	<tr style="background-color:<?php
		if (array_key_exists($statusPdetail, $legendColorStatus)) {
				    echo $legendColorStatus[$statusPdetail];
				}
		?>" id='<?php echo $detId; ?>'>
		<th scope="row"><?php echo h($Pdetail['Pdetail']['project_id']); ?></th>
		<td><?php echo h($Pdetail['Pdetail']['deadline']); ?></td>
		<td id='tab-click'><?php echo h($Pdetail['Pdetail']['issue_no']); ?></td>
		<td><?php echo h($Pdetail['Pdetail']['task_description']); ?></td>
		<td>
			<div class="pull-right sub-menu">
				<?php
				 echo $this->Form->input('member', array(
					'type'=>'select', 
					'label' => '', 
					'empty' => 'Please Select',
					'selected' => $Pdetail['Pdetail']['member']
					)
				); ?>
			</div>
		</td>
		<td>
			<a href="<?php echo h($Pdetail['Pdetail']['issue_link']);?>" target="_blank">
			<?php
				$link = $Pdetail['Pdetail']['issue_link'] <> '' ? substr($Pdetail['Pdetail']['issue_link'],0,15).'...' : ' ';
			?>
			<?php echo h($link);?>
			</a>
		</td>
		<td>
			<div class="pull-right sub-menu">
				<?php echo $this->Form->input('status', array(
				'type'=>'select', 
				'label' => '', 
				'default' => $Pdetail['Pdetail']['status'],
				'selected' => $Pdetail['Pdetail']['status'],
				'options' => $legendStatusId
					)
				); 
				echo $this->Form->hidden('projID', array('value' => $Pdetail['Pdetail']['project_id'], 'id' => 'projID'));
				echo $this->Form->hidden('id', array('type' => 'hidden', 'value' => $Pdetail['Pdetail']['id'], 'id' => 'pID'));
				?>
		</td>
		<td id="<?php echo $Pdetail['Pdetail']['id']; ?>">
			<?php 
				echo $this->Form->input('priority', array(
					'type'=>'select', 
					'label' => '',
					'class' => 'example-pill',
					'selected' => $Pdetail['Pdetail']['priority'],
					'default' => $Pdetail['Pdetail']['priority'],
					'options'=> $priorityBar
					)
				); 
				if($Pdetail['Pdetail']['status'] == '4'){ 
			?>
				<input type='button' value='Bug Info' class='btn btn-info btn-sm sub-menu' id='bug-info' onclick="checkBugInfo('<?php echo $detId; ?>')">
			<?php } ?>
			</div>
		</td>
		<!-- progress -->
		<td id="<?php echo $Pdetail['Pdetail']['id']; ?>p">
		<?php 
			echo $this->Form->input('progress', array(
				'type'=>'select', 
				'label' => '',
				'class' => 'example-1to10',
				'selected' => $Pdetail['Pdetail']['progress'],
				'default' => $Pdetail['Pdetail']['progress'],
				'options'=> $progressBar
				)
			); 
		?>
		</td>
		<!-- end progress -->
		<script type="text/javascript">
			$(document).ready(function(){
				var id = "<?php echo $Pdetail['Pdetail']['id']; ?>";
				var projID = <?php echo $Pdetail['Pdetail']['id']; ?>;
				var selected =  <?php echo $Pdetail['Pdetail']['priority']; ?>;
				//priority
				for (i = 1; i <= selected; i++) { 
					$("#"+id).find('[href="#"]').attr("gval", id);
				    if(i != selected){
				    	$("#"+id).find('[data-rating-value="'+i+'"]').addClass("br-selected");
				    }else{
				    	$("#"+id).find('[data-rating-value="'+i+'"]').addClass("br-selected br-current");
				    }
				}
				//progressBar
				var progID = "<?php echo $Pdetail['Pdetail']['id']; ?>p";
				var progressBar =  <?php echo $Pdetail['Pdetail']['progress']; ?>;
				for (p = 0; p <= progressBar; p++) { 
					$("#"+progID).find('[href="#"]').attr("gval", id);
				    if(p != progressBar){
				    	$("#"+progID).find('[data-rating-value="'+p+'"]').addClass("br-selected");
				    }else{
				    	$("#"+progID).find('[data-rating-value="'+p+'"]').addClass("br-selected br-current");
				    }
				}
			});
		</script>
	<td>
	<?php echo $this->Form->input('id', array('type' => 'hidden', 'value' => $Pdetail['Pdetail']['id']));?>
	<?php echo $this->Form->submit(__('Update'), array('class' => 'btn btn-primary btn-xs submitButton'),array('action' => 'index')); ?>
	<?php echo $this->Html->link(__(''), array('action' => 'edit', $Pdetail['Pdetail']['id']), array('data-toggle' => 'modal', 'data-target' => '#editForm', 'class' => 'glyphicon glyphicon-pencil', 'id' =>'formEdit')); ?>
	<?php echo $this->Form->postLink(__(''), array('action' => 'delete', $Pdetail['Pdetail']['id'], $Pdetail['Pdetail']['project_id'], 'class' => 'glyphicon glyphicon-trash'), array('confirm' => __('Are you sure you want to delete this Project?'), 'class' => 'glyphicon glyphicon-trash')); ?>


	</td>
</tr>
<?php
	if($Pdetail['Pdetail']['status'] != $break_row){
		if(!isset($legendStatusId[$break_row]))
			$r = '';
		else
			$r = $legendStatusId[$break_row];

		echo '<tr><th colspan=11></th></tr>';
	}
		$i= $Pdetail['Pdetail']['status'];
		endforeach;
?>
</tbody>
</table>