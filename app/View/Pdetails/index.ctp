<div class="container-fluid">
	<h3>Project Detail</h3>
	<div class="row">
		<div class="col-md-8">
			<?php 
				date_default_timezone_set("Asia/Manila"); 
				$todayDate = date("Y-m-d"); 
				$baseUrl= Router::url('/', true);
				echo $this->Html->link(__('Project List'), array('controller' => 'Projects', 'action' => 'index'), array('class' => 'btn btn-primary'));
				echo $this->Html->link(__('Create New Issue'), array('action' => 'add', $p_id), array('class' => 'btn btn-success', 'data-toggle' => 'modal', 'data-target' => '#addForm'));
			?>
		</div>
		Legend: 
		<?php
			$statusArray= array();
			$colorArray = array();
			foreach ($legendStatusId as $statusId => $status) {
				$statusArray[] = $status;
			}

			//debug($legendColor);
			 foreach ($legendColor as $key => $value): ?>
				<span class="label color-box" style="background-color:<?php echo $key;?>"  id="<?php echo $key;?>">
					<?php 
						$colorArray[] = $key;
						echo $value;
					?>
				</span>
		<?php endforeach; ?>
			<a href="#" class="btn-setting"><img class='legend-modal' src='<?php echo $baseUrl; ?>img/setting.png' style='width:18px;height=18px'></a>
	</div>
</div>	
<hr>
<div class="container-fluid">
	<div class="row">
		<table class="table table-striped" id='tab-click'>
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
					<th>Modified Date</th>
					<th class="actions">Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$selectedStatus = array();
					$tempar = array();
					$temp2 = array();
					$countArr = count($pdetails);
					//echo '<h2>'.$pdetails[0]['TblColor']['status'].'</h2>';
					foreach ($pdetails as $key=>$Pdetail):
						if($key === 0)
						//echo '<h2>'.$pdetails[$key]['TblColor']['status'].'</h2>';
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
							<td><?php echo h($Pdetail['Pdetail']['project_id']); ?></td>
							<td><?php echo h($Pdetail['Pdetail']['deadline']); ?></td>
							<td><?php echo h($Pdetail['Pdetail']['issue_no']); ?></td>
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
								<a href="<?php echo h($Pdetail['Pdetail']['issue_link']);?>" target="_blank"><?php echo h($Pdetail['Pdetail']['issue_link']);?></a>
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
							
							<td><?php echo h($Pdetail['Pdetail']['created']); ?></td>
							<td class="actions">
								 <div class="pull-right sub-menu">
								<?php echo $this->Form->input('id', array('type' => 'hidden', 'value' => $Pdetail['Pdetail']['id']));?>

								<?php echo $this->Form->submit(__('Update Status'), array('class' => 'btn btn-primary btn-xs'),array('action' => 'index')); ?>
								<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $Pdetail['Pdetail']['id']), array('data-toggle' => 'modal', 'data-target' => '#editForm')); ?>
								<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $Pdetail['Pdetail']['id'], $Pdetail['Pdetail']['project_id']), array('confirm' => __('Are you sure you want to delete this Project?'))); ?>
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

							?>
						
					<?php
						$i= $Pdetail['Pdetail']['status'];
					endforeach; 
					?>
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


<div class="bs-example"></div>



   <!-- Button HTML (to Trigger Modal) -->
    
    
    <!-- Modal HTML -->
    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Legend Settings</h4>
                </div>
                <div class="modal-body">
                	
                	<div id='table-legend'>
                		<?php
							$imploded = implode('|', $selectedStatus);
							$colorArrayImploded = implode('|', $colorArray);
							
                		?>
                		<input type="hidden" value="<?php  echo $imploded; ?>" id="hide-status">
                		<input type="hidden" value="<?php  echo $colorArrayImploded; ?>" id="hide-color">


                	<table class='table table-striped'>
                		<tr>
                			<td colspan='2'><input type='radio' id='radio-legend'>Add Legend

                				<div id='add-legend' style='display:none'>

                					<input type="text" id="legend-add" style='float:left'>
                					 <div class="colorpicker-component demo demo-auto">
					                    <input type="hidden" value="#ffffff" id='color-pick'/>
					                 
					                    <input type='text' class='input-group-addon'>
					                  </div>
                				<input type='button' class='btn btn-primary btn-sm' style='float:left' onclick='insertLegend("insertLegend");' value="ADD" >
                				</div>
                			
                			</td>
                		</tr>
                		<?php
                		  foreach ($legendColorModal as $value): 
                		  	echo $value['Tblcolor']['color'];
                		  	?>
                		<tr>
                			<td>
								<span class="label color-box2" style="background-color:<?php echo $value['Tblcolor']['color'];?>; z-index: 1022;"  id="<?php echo $value['Tblcolor']['color'];?>"><?php echo $value['Tblcolor']['status'];?></span>
							</td>
							<td> 
								<input type='button' class='btn btn-primary btn-sm' onclick='showEdit("<?php echo $value['Tblcolor']['status']; ?>")' value='EDIT'>
								<input type='button' class='btn btn-primary btn-sm' onclick='if(confirm("Are you Sure?") == true)editDeleteLegend("deleteLegend","<?php echo $value['Tblcolor']['status']; ?>","<?php echo $value['Tblcolor']['status_id']; ?>")' value="DELETE" id='legend-delete'>
							</td>
							<?php endforeach;?>
                		
                	</table>
                	</div>	
                	<div id="divEdit" style="display:




                	none">
                		<div id='back'  style='margin-bottom:30px;'><img class='legend-modal' onclick='backFunction()' src='<?php echo $baseUrl; ?>img/back.png' style='width:18px;height=18px'>
                		</div>
                		<input type='text' id='edit-status'>
                		<input type='button' class='btn btn-primary btn-sm' onclick='editLegend("editLegend");' value="SAVE" id='legend-edit'>
                		<input type='hidden' id='edit-hidden'>
                	</div>


                </div>
              
            </div>
        </div>
    </div>

<?php echo $this->element('pdetailsIssueSpecs'); ?> <!--Issue Specs Page -->

<?php echo $this->element('pdetailsBugInfo'); ?> <!--Bug Info Page -->

<?php echo $this->Html->script(array('pdetails')); ?> <!--js -->


