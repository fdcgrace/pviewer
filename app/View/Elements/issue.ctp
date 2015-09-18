<?php
	echo $this->Html->css('bars-1to10', null, array('inline' => true));
	echo $this->Html->css('bars-pill', null, array('inline' => true));
	echo $this->Html->script('jquery.barrating', array('inline' => true));
	echo $this->Html->script('bars', array('inline' => true));	
?>
<div class="container-fluid" style="margin:0 0 10px 0; padding-left:0px;">
	<?php
	echo $this->Html->link(__('Create New Issue'), array('action' => 'add', $p_id), array('class' => 'btn btn-success fleft', 'data-toggle' => 'modal', 'data-target' => '#addForm'));
	?>
</div>
<div class="panel panel-default" style="padding-left:0px;">
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
			if(count($pdetails) > 0) {
				$selectedStatus = array();
				$tempar = array();
				$temp2 = array();
				$countArr = count($pdetails);
				$cnt = 0;
				$tempCar = "";
				foreach ($pdetails as $key=>$Pdetail):
					$getstatus = $Pdetail['Pdetail']['status'];
					$detId = $Pdetail['Pdetail']['id'];
					echo $this->Form->create('Pdetail');
					if ($cnt > 0) {
						if($tempCar <> $getstatus){
							echo '<tr><th colspan=11></th></tr>';
						}else{							
						}
					}else{			
					}
				$tempCar = $getstatus;
				$cnt++;
			?>
			<tr style="background-color:<?php
				if (array_key_exists($getstatus, $legendColorStatus)) {
					   echo $legendColorStatus[$getstatus];
					}
				?>" id="<?php echo $Pdetail['Pdetail']['id']; ?>">
				<th scope="row"><?php echo h($Pdetail['Pdetail']['project_id']); ?></th>
				<td><?php echo h($Pdetail['Pdetail']['deadline']); ?></td>
				<td id='tab-click'><?php echo h($Pdetail['Pdetail']['issue_no']); ?></td>
				<td><?php echo h($Pdetail['Pdetail']['task_description']); ?></td>
				<td>
					<?php
						echo  empty($Pdetail['Pdetail']['member']) ? 'No person assigned' : $members[$Pdetail['Pdetail']['member']] ;
					?>
				</td>
				<td>
					<a href="<?php echo h($Pdetail['Pdetail']['issue_link']);?>" target="_blank">
					<?php
						$link = $Pdetail['Pdetail']['issue_link'] <> '' ? substr($Pdetail['Pdetail']['issue_link'],0,15).'...' : '';
					?>
					<?php echo h($link);?>
					</a>
				</td>
				<td>
					<div class="pull-right sub-menu">
						<?php 
							$stat = $Pdetail['Pdetail']['status'];
							foreach ($legendColorModal as $key => $value) {
								foreach ($value as $nkey => $nval) {
									if($stat == $nval['status_id']){
								        echo $nval['status']; 
								    }
								}
							}
							echo $this->Form->hidden('projID', array('value' => $Pdetail['Pdetail']['project_id'], 'id' => 'projID'));
							echo $this->Form->hidden('id', array('type' => 'hidden', 'value' => $Pdetail['Pdetail']['id'], 'id' => 'pID'));
							echo $this->Form->hidden('ino', array('type' => 'hidden', 'value' => $Pdetail['Pdetail']['issue_no'], 'id' => 'ino'));
							echo $this->Form->hidden('task_description', array('type' => 'hidden', 'value' => $Pdetail['Pdetail']['task_description'], 'id' => 'desc'));
							echo $this->Form->hidden('issue_link', array('type' => 'hidden', 'value' => $Pdetail['Pdetail']['issue_link'], 'id' => 'ilink'));
						?>
					</div>
				</td>
				<td id="<?php echo $Pdetail['Pdetail']['id']; ?>">
					<?php 
						echo $this->Form->input('priority', array(
							'type'=>'select', 
							'label' => false,
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
				</td>
				<!-- progress -->
				<td id="<?php echo $Pdetail['Pdetail']['id']; ?>">
					<?php 
						echo $this->Form->input('progress', array(
							'type'=>'select', 
							'label' => false,
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
						var selected =  <?php echo ($Pdetail['Pdetail']['priority']) ? $Pdetail['Pdetail']['priority'] : '1'; ?>;
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
						var progressBar =  <?php echo ($Pdetail['Pdetail']['progress']) ? $Pdetail['Pdetail']['progress'] : '1'; ?>;
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
				<?php echo $this->Html->link(__(''), array('action' => 'edit', $Pdetail['Pdetail']['id']), array('data-toggle' => 'modal', 'data-target' => '#editForm', 'class' => 'glyphicon glyphicon-pencil', 'id' =>'formEdit')); ?>
				<?php echo $this->Html->link(__(''), array('action' => 'delete', $Pdetail['Pdetail']['id'], $Pdetail['Pdetail']['project_id']), array('confirm' => __('Are you sure you want to delete this Project?'), 'class' => 'glyphicon glyphicon-trash')); ?>

				</td>
			</tr>
		<?php
				endforeach;
		} /*-----end of first if-------*/ 
		 else { ?>
			<tr><td colspan="10" style="text-align:center"><h4><b>No Issues</b></h4></td></tr>
		<?php } ?>
		</tbody>
	</table>
</div>

<input type="hidden"  name="selected" id="selected" value="<?php echo $selected; ?>">
